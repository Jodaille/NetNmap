@extends('layout')
@section('title', "Map")
@section('description', "Map")


@section('content')
<div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
    <div class="grid grid-cols-1 md:grid-cols-2">
        <table >
            <thead>
                <tr>
                  <th >Nom</th>
                  <th >IP</th>
                  <th >MAC</th>
                  <th >Up (ago)</th>
                </tr>
              </thead>
            <tbody>
                @foreach ($hosts as $host)
                <tr>
                    <th >{{$host->name}}</th>
                    <td >{{$host->lastIp}}</td>
                    <td >{{$host->mac}}</td>
                    <td >{{$host->lastUp}}</td>
                  </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('css')
<style>
thead th {
    border: 1px solid;
}
td, th {
  padding: 5px;
}
</style>
@endsection

@section('js')
<script>
    console.log('Hosts');
</script>
@endsection
