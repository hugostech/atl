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
                            <th class="text-center w-1"><i class="icon-people"></i></th>
                            <th>Name</th>
                            <th>Company</th>
                            <th class="text-center"><i class="icon-settings"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        {{ Form::hidden('domain', Request::root() ) }}
                        @foreach($drivers as $driver)
                        <tr>
                            <td class="text-center">
                                <div class="avatar d-block" style="background-image: url({{asset('logos/Mercedes-Benz-logo.png')}})">
                                    <span class="avatar-status bg-green"></span>
                                </div>
                            </td>
                            <td>
                                <div class="text-uppercase">{{$driver->name}}</div>
                            </td>
                            <td>
                                <div class="small text-muted">Company</div>
                                <div>{{ $driver->company }}</div>
                            </td>
                            
                            <td class="text-center">
                                <div class="item-action dropdown">
                                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{route('driver_edit',['id'=>$driver->id])}}" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Edit </a>
                                        <a href="{{route('driver_delete',['id'=>$driver->id])}}" class="dropdown-item text-danger" onclick="return confirm('Are you sure to delete?')"><i class="dropdown-icon fe fe-delete"></i> Delete</a>
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

            <div class="text-center" id="qr_code">
            
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="download" name="" onclick="downloadQRCode(this)" data-dismiss="modal">Download QR Code</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                
            </div>
        </div>
    </div>
</div>

<script>
    function showlink(obj, url) {
        $('#url_label').html(url);

        var plate = $(obj).attr("data-plate");
        var sharing_mark = $(obj).attr("id");
        domain = $('[name="domain"]').val();

        var qr_code_url = domain + "/qr_code/" + sharing_mark;
        var img_qr_code = "<img src='" + qr_code_url + "' title='" + qr_code_url + "' />";        
        $('#qr_code').html(img_qr_code);   
        $('#download').attr('data-qr_code_url', qr_code_url);  
        $('#download').attr('data-plate', plate);   
    }
    function downloadQRCode(obj) {
        url = $(obj).attr("data-qr_code_url");
        plate = $(obj).attr("data-plate");

        var a = $("<a>")
            .attr("href", url)
            .attr("download", plate + ".png")
            .appendTo("body");

        a[0].click();
        a.remove();
    }
</script>
@endsection
