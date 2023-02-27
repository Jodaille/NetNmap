<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DOMElement;
use DOMDocument;
use DOMXPath;

use App\Models\Host;
use Carbon\Carbon;

class NmapParser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nmap:parse {nmapxml}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $path = $this->argument('nmapxml');
        $xml = file_get_contents($path);
        libxml_use_internal_errors(true);
        $dom = new DOMDocument;
        $dom->loadXML($xml);
        libxml_use_internal_errors(false);
        $xpath = new DOMXPath($dom);
        $hosts = $xpath->query('//host');
        foreach($hosts as $host) {
            $macAddress = false;
            $vendor = false;
            $status  = $host->getElementsByTagName('status')->item(0);
            $macNode = $xpath->query('.//address[contains(@addrtype, "mac")]', $host)->item(0);
            $ip4Node = $xpath->query('.//address[contains(@addrtype, "ipv4")]', $host)->item(0);

            /** @var DOMElement $ip4Node */
            $ipv4Address = $ip4Node->getAttribute('addr');

            if ($macNode) {
                /** @var DOMElement $macNode */
                $macAddress = $macNode->getAttribute('addr');
                $vendor = $macNode->getAttribute('vendor');
                $this->addHost($macAddress, [
                    'vendor' => $vendor,
                    'lastIp' => $ipv4Address,
                    'lastUp' => Carbon::now(),
                ]);
            }

            $this->info("{$macAddress} {$ipv4Address} {$vendor}");
        }
    }

    public function addHost($macAddress, $attributes = [])
    {
        $host = Host::byMacAddress($macAddress);
        if (!$host) {
            $host = new Host();
            $host->mac = $macAddress;
        }
        if (isset($attributes['vendor'])) {
            $host->vendor = $attributes['vendor'];
        }
        if (isset($attributes['lastIp'])) {
            $host->lastIp = $attributes['lastIp'];
        }
        if (isset($attributes['lastUp'])) {
            $host->lastUp = $attributes['lastUp'];
        }
        $host->save();
        return $host;
    }
}
