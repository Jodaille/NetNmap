@extends('layout')
@section('title', "Map")
@section('description', "Map")


@section('content')
<div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
    <div class="grid grid-cols-1 ">
        <table >
            <thead>
                <tr>
                  <th >Nom</th>
                  <th >Vendor</th>
                  <th >IP</th>
                  <th >MAC</th>
                  <th >Up (ago)</th>
                </tr>
              </thead>
            <tbody>
                @foreach ($hosts as $host)
                <tr>
                    <th data-id="{{$host->id}}" data-currentName="{{$host->name}}" class="">{{$host->name}} <i class="las la-edit hostName"></i></th>
                    <th >{{$host->vendor}}</th>
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
    const UrlUpdateHost = '{{ route('host.update') }}';
    const token = document.querySelector('meta[name="csrf-token"]');

    /**
     * Edit icon event
     */
    document.querySelectorAll('.hostName').forEach(function(th) {
        th.addEventListener('click', textToInput, false);
    });

    /**
     * Convert name to input text
     */
    function textToInput(event) {
        var icon = event.currentTarget;
        var th = icon.parentNode;
        var id = th.dataset.id;
        console.log(th, id, th.dataset);
        let input = document.createElement('input');
        let validateIcon = document.createElement('i');
        validateIcon.classList.add('la-check');
        validateIcon.classList.add('las');
        validateIcon.addEventListener('click', publishChange, false);
        input.type = 'text';
        input.name = 'hostName';
        input.value = th.dataset.currentname;
        th.innerText = '';
        th.appendChild(input);
        th.appendChild(validateIcon);
    }

    /**
     * Publish/update new name
     */
    function publishChange(event) {
        var icon = event.currentTarget;
        var th = icon.parentNode;
        var id = th.dataset.id;
        var input = th.querySelector('input');

        const params = {
            id: id,
            name: input.value,
        };
        const options = {
            method: 'POST',
            body: JSON.stringify( params ),
            headers: {
                "X-CSRF-TOKEN": token.content
            }
        };

        fetch(UrlUpdateHost, options)
        .then(function(response) {
            return response.json();
        })
        .then(function(json) {
            let th = document.querySelector(`[data-id='${json.id}']`);
            console.log(json.id, th);
            let editIcon = document.createElement('i');
            editIcon.classList.add('la-edit');
            editIcon.classList.add('las');
            editIcon.classList.add('hostName');
            editIcon.addEventListener('click', textToInput, false);
            th.innerText = `${json.host.name} `;
            th.appendChild(editIcon);
        })
        .catch(function(error) {
            console.log(error)
        })
    }
</script>
@endsection
