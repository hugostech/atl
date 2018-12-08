@extends('layouts.dashboard2')

@section('page')
<div class="container">
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div class="alert alert-success">
            <strong>Success!</strong> {{\Illuminate\Support\Facades\Session::get('success')}}
        </div>
    @endif
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                        <tr>                          
                            <th>Name</th>
                            <th>Email</th>
                            <th>Is Admin</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="text-left">
                                <div >{{$user->name}}</div>
                            </td>
                            <td>
                                <div>{{$user->email}}</div>
                            </td>
                            <td>
                                hit
                            </td>
                            
                            <td class="text-center">
                                <div class="item-action dropdown">
                                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{route('car_edit',['id'=>$user->id])}}" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Edit </a>
                                        <a href="{{route('car_delete',['id'=>$user->id])}}" class="dropdown-item text-danger" onclick="return confirm('Are you sure to delete?')"><i class="dropdown-icon fe fe-delete"></i> Delete</a>
                                        </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Share Link</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <label class="form-label" id="url_label">Loading...</label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showlink(url) {
        $('#url_label').html(url)
    }
</script>
@endsection
