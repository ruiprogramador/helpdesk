@extends('layouts.app', ['activePage' => 'ticket', 'title' => 'Help Desk System - Tickets', 'navName' => 'Tickets', 'activeButton' => 'ticket'])

@php
    use App\Helpers\GlobalHelper;

    $helper = new GlobalHelper();

@endphp

@section('content')
    <div class="content">
        <div class="container-fluid container_user_auth">
            <div class="section-card">
                <!-- Ticket Details -->
                <div class="card">

                        <form @if (1 == 1 && $ticketAction == 'edit') action="{{ route('tickets.update', ['ticket' => $ticket[0]->ticket_id]) }}" @else action="{{ route('tickets.store') }}" @endif method="POST">
                            @csrf
                            @if (1 == 1 && $ticketAction == 'edit')
                                @method('PUT')
                            @endif

                            <input type="hidden" name="ticketAction" value="{{ $ticketAction }}">

                            <div class="card-header">
                                @if (1 == 1 && $ticketAction == 'show')
                                    <h4
                                        class="card-title
                                            @if (strtolower($ticket[0]->status) == 'open')
                                                text-danger
                                            @endif
                                        "
                                    >
                                        {{ $ticket[0]->title }}
                                    </h4>
                                @else
                                    <input type="text" name="title" id="title" class="form-control" value="{{ 1 == 1 && isset($ticket[0]->title) ? $ticket[0]->title : '' }}" placeholder="Title">
                                @endif
                            </div>
                            <!-- Ticket Details -->
                            <div class="card-body">
                                <input type="hidden" name="ticket_id" value="{{ 1 == 1 && isset($ticket[0]->ticket_id) ? $ticket[0]->ticket_id : '' }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        @if (1 == 1 && $ticketAction != 'create')
                                            <p>
                                                <strong>Created At:</strong> {{ 1 == 1 && isset($ticket[0]->created_at) ? $ticket[0]->created_at : '' }}
                                            </p>
                                        @endif
                                        @if (1 == 1 && $ticketAction != 'create')
                                            <p>
                                                <strong>Created By:</strong> {{ $ticket[0]->first_name }}
                                            </p>
                                        @endif
                                        {{-- Status --}}
                                        <p>
                                            <strong>Status:</strong>
                                            @if (1 == 1 && $ticketAction == 'show')
                                                <span>{{$helper->capitalize($ticket[0]->status)}}</span>
                                            @else
                                                <select name="status_id" id="status_id" class="form-control">
                                                    <option value="">Select Status</option>
                                                    @foreach ($status_list as $status);
                                                        <option value="{{ $status->status_id }}"
                                                            @if (1 == 1 && isset($ticket[0]) && $status->status_id == $ticket[0]->status_id)
                                                                selected
                                                            @endif
                                                        >
                                                            {{ $helper->capitalize($status->status) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </p>
                                        <p>
                                            <strong>Priority:</strong>
                                            @if(1 == 1 && $ticketAction == 'show')
                                                <span>{{$helper->capitalize($ticket[0]->priority)}}</span>
                                            @else
                                                <select name="priority_id" id="priority_id" class="form-control">
                                                    <option value="">Select Priority</option>
                                                    @foreach ($priorities_list as $priority)
                                                        <option value="{{$priority->priority_id}}"
                                                            @if (1 == 1 && isset($ticket[0]) && $priority->priority_id == $ticket[0]->priority_id)
                                                                selected
                                                            @endif
                                                        >
                                                            {{ $helper->capitalize($priority->priority) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        {{-- Category --}}
                                        <p>
                                            <strong>Category:</strong>
                                            @if (1 == 1 && $ticketAction == 'show')
                                                <span>{{ $ticket[0]->category }}</span>
                                            @else
                                                <select name="category_id" id="category_id" class="form-control">
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories_list as $category)
                                                        <option value="{{ $category->category_id }}"
                                                            @if (1 == 1 && isset($ticket[0]) && $category->category_id == $ticket[0]->category_id)
                                                                selected
                                                            @endif
                                                        >
                                                            {{ $category->category_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </p>
                                        {{-- <p>
                                            <strong>Subcategory:</strong> {{ $ticket[0]->subcategory_name }}
                                        </p> --}}

                                        {{-- Assigned To --}}
                                        <p>
                                            <strong>Assigned By:</strong>
                                            @if (1 == 1 && $ticketAction == 'show')
                                                <span>{{$ticket[0]->assigned_by}}</span>
                                            @else
                                                <select name="assigned_by" id="assigned_by" class="form-control">
                                                    <option value="">Select User</option>
                                                    @foreach ($users_list as $user)
                                                        <option value="{{ $user->user_id }}"
                                                            @if (1 == 1 && isset($ticket[0]) && $user->user_id == $ticket[0]->assigned_by)
                                                                selected
                                                            @endif
                                                        >
                                                            {{ $user->first_name }} {{ $user->last_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </p>
                                        <p>
                                            <strong>Type:</strong>
                                            @if (1 == 1 && $ticketAction == 'show')
                                                <span>{{$ticket[0]->type}}</span>
                                            @else
                                                <select name="type_id" id="type_id" class="form-control">
                                                    <option value="">Select Type</option>
                                                    @foreach ($types_list as $type)
                                                        <option value="{{ $type->type_id }}"
                                                            @if (1 == 1 && isset($ticket[0]) && $type->type_id == $ticket[0]->type_id)
                                                                selected
                                                            @else
                                                                @if (1 == 1 && isset($ticket_type) && $type->type_id == $ticket_type)
                                                                    selected
                                                                @endif
                                                            @endif
                                                        >
                                                            {{ $type->type }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </p>
                                        @if (1 == 1 && isset($ticket[0]))
                                            <p>
                                                <strong>Updated At:</strong> {{ $ticket[0]->updated_at }}
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <p>
                                            <strong>Description:</strong>
                                            @if (1 == 1 && $ticketAction == 'show')
                                                {{$ticket[0]->description}}
                                            @else
                                                <textarea name="description" id="description" class="form-control" rows="5" value="">{{ 1 == 1 && isset($ticket[0]->description) ? $ticket[0]->description : 'asas' }}</textarea>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- Ticket Comments -->
                            @if(1 == 1 && $ticketAction == 'show')
                                <div class="card-body">
                                    <h4 class="card-title
                                        @if (strtolower($ticket[0]->status) == 'open')
                                            text-danger
                                        @endif
                                    ">
                                        Comments
                                    </h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-hover" id="comments-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Comment</th>
                                                            <th>Created At</th>
                                                            <th>Created By</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(1 == 1 && isset($ticket[0]->comments) && count($ticket[0]->comments) > 0)
                                                            @foreach ($ticket[0]->comments as $comment)
                                                                <tr>
                                                                    <td>{{ $comment->comment }}</td>
                                                                    <td>{{ $comment->created_at }}</td>
                                                                    <td>{{ $comment->first_name }}</td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="4">No comments found</td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="card-footer">
                                <a href="{{ route('tickets.index') }}" class="btn btn-primary">Back</a>
                            </div>
                            @if (1 == 1 && $ticketAction != 'show')
                                <div class="row" align="center">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            @endif
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
