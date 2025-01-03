@extends('layouts.app', ['activePage' => 'ticket', 'title' => 'Help Desk System - Tickets', 'navName' => 'Tickets', 'activeButton' => 'ticket'])

@php
    use App\Helpers\GlobalHelper;

    $helper = new GlobalHelper();
@endphp

@section('content')
    <div class="content">
        <div class="container-fluid container_user_auth">
            <div class="section-card">
                <table class="table table-bordered table-striped table-hover" id="tickets-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Created At</th>
                            <th>Created By</th>
                            <th>Total Comments</th>
                            <th
                                data-orderable="false"
                            >
                                Actions

                                {{--
                                    <a href="{{ route('tickets.create') }}">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                --}}

                                {{-- DropDown Menu with Ticket : Request a service / Report a problem --}}
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        {{-- <a class="dropdown-item" href="{{ route('tickets.create', ['type' => 'service']) }}">Request a service</a>
                                        <a class="dropdown-item" href="{{ route('tickets.create', ['type' => 'problem']) }}">Report a problem</a> --}}

                                        @if(1 == 1 && isset($ticket_types) && is_array($ticket_types) && count($ticket_types) > 0)
                                            @foreach ($ticket_types as $ticket_type)
                                                <a class="dropdown-item" href="{{ route('tickets.create', ['type' => $ticket_type->type_id]) }}">{{ $ticket_type->type }}</a>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                            <tr>
                                <td>{{ $ticket->ticket_id }}</td>
                                <td>{{ $ticket->title }}</td>
                                <td>{{ $helper->capitalize($ticket->status) }}</td>
                                <td>{{ $helper->capitalize($ticket->priority) }}</td>
                                <td>{{ $ticket->created_at }}</td>
                                <td>{{ $ticket->first_name }}</td>
                                <td>{{ $ticket->comments_count }}</td>
                                <td class="actions_list_tables">
                                    {{-- View Ticket --}}
                                    <a href="{{ route('tickets.show', $ticket->ticket_id) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    {{-- Edit Ticket --}}
                                    <a href="{{ route('tickets.edit', $ticket->ticket_id) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    {{-- <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let table = new DataTable('#tickets-table', {
            dom: 'Blfrtip',
            searchable: true,
            sortable: true,
            perPage: 25,
            perPageSelect: [5, 10, 20, 50, 100],
            language: {
                'perPage': 'Mostrar _MENU_',
                'search': 'Pesquisar',
                'info': 'Mostrando _START_ a _END_ de _TOTAL_ entradas',
                'infoEmpty': 'Mostrando 0 a 0 de 0 entradas',
                'lengthMenu': 'Mostrar _MENU_ entradas',
                'emptyTable': 'Nenhum dado disponível na tabela',
                'zeroRecords': 'Nenhum dado encontrado',
                'infoFiltered': '(filtrado de _MAX_ total entradas)',
            },buttons: [
                // 'copy', 'csv', 'excel', 'print'
                {
                    extend: 'copy',
                    text: 'Copiar',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'csv',
                    text: 'CSV',
                    className: 'btn btn-secondary',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    className: 'btn btn-outline-primary',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'print',
                    text: 'Imprimir',
                    className: 'btn btn-outline-secondary',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                }
            ]
        });
    </script>
@endpush
