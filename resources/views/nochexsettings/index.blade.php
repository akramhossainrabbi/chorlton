@extends('layout.master')
@section('title')
Nochex Settings Info
@endsection

@include('extra.msg')

@section('content')
<!-- Main content -->
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-plus"></i> 
                    @if(isset($edit))
                    Change Nochex Settings
                    @else
                    Create Nochex Settings
                    @endif
                </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            @if(isset($edit))
                <form method="post" role="form" action="{{url('admin-ecom/nochexsetting-update')}}">
            @else
                <form method="post" role="form" action="{{url('admin-ecom/nochexsetting-add')}}">
            @endif
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nochex Merchant ID / Email Address</label>
                        <input type="text" class="form-control" id="nochex_merchant_id" name="nochex_merchant_id" value="{{$edit->nochex_merchant_id}}" placeholder="Enter Nochex Merchant ID / Email Address">
                    </div>
                   
                    <div class="form-group">
 
                        <input type="checkbox" class="minimal"  name="nochex_status" 
                        @if(isset($edit))
                            @if($edit->nochex_status == "Active")
                                checked="checked" 
                            @endif 
                        @endif 
                        placeholder="Enter Name"> <label style="margin-left: 5px;" for="exampleInputPassword1"> Is Active</label>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    @if(isset($edit))
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button> 
                    @else
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button> 
                    @endif
                    <button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Reset</button>
                </div>
            </form>
        </div>
        <!-- /.box -->

    </div>
    <!--/.col (left) -->
</div>
<!-- /.content -->
@endsection
