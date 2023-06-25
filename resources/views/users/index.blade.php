@extends('layouts.app')

@section('header_extra')
    <meta name="page" content="options" initial="options">
    <style>
        .btn-action {
            font-weight: 500 !important;
        }
        .btn-action:hover {
            color: #fff !important;
        }
    </style>
@endsection

@section('content')

    @include('layouts.parts.nav-2')
    @include('layouts.parts.navbar')

    <div class="py-main">
        <div class="container container-sm">
            <div class="heading my-3 my-lg-4">
                <h1>Users</h1>
            </div>
            <div class="box-general diff-so shadow">
                <div class="heading">
                    <div class="row">
                        <div class="col-6">
                            <h3><a href="{{route('settings_index')}}" class="back"><img src="{{ asset('frontend/img/pinpoint/icon/ic-left.svg')}}" class="img-fluid img-icon" alt="Icon"></a> Settings</h3>
                        </div>
                        <div class="col-6">
                            <a href="{{route('users.create')}}" class="btn btn-sm btn-success float-right">Add User</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-option">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Roles</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($data as $key => $user)
                                <tr>
                                  <td>{{ $user->name }}</td>
                                  <td>{{ $user->email }}</td>
                                  <td>
                                    @if(!empty($user->getRoleNames()))
                                      @foreach($user->getRoleNames() as $v)
                                        <label class="badge badge-success">{{ $v }}</label>
                                      @endforeach
                                    @endif
                                  </td>
                                  <td>
                                    <!-- <a class="btn btn-sm btn-info" href="{{ route('users.show',$user->id) }}">Show</a> -->
                                    <!-- <a class="btn btn-sm btn-warning" href="{{ route('users.edit',$user->id) }}">Edit</a> -->
                                      <!-- {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                          {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) !!}
                                      {!! Form::close() !!} -->
                                  </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer_extra')
    <script>
        var numShown = 4; // Initial rows shown & index
        var numMore = 4;  // Increment

        var $table = $('table').find('tbody');  // tbody containing all the rows
        var numRows = $table.find('tr').length; // Total # rows

        $(function () {
            // Hide rows and add clickable div
            $table.find('tr:gt(' + (numShown - 1) + ')').hide().end()
                .after('<tbody id="more" class="text-center border-0"><tr><td colspan="' +
                    $table.find('tr:first td').length + '"><div class="btn btn-border green">Load More Data</div</tbody></td></tr>');

            $('#more').click(function() {
                numShown = numShown + numMore;
                // no more "show more" if done
                if (numShown >= numRows) {
                    $('#more').remove();
                }
                // change rows remaining if less than increment
                if (numRows - numShown < numMore) {
                    $('#more span').html(numRows - numShown);
                }
                $table.find('tr:lt(' + numShown + ')').show();
            });

        });
    </script>
@endsection