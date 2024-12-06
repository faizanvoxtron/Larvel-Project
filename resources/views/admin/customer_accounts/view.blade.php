<div class="container my-3">
    <div class="card p-3">
        <div class="row">
            <div class="col-md-12">
                <div class="box-header with-border">
                    <div class="d-flex justify-content-between">
                        <h5>Accounts</h5>
                        <a href="#" class="btn-success btn-sm btn mb-2 cursor-pointer add_account" data-customer_id="{{$customer_id }}">
                            <i class=" icon-add"></i>
                            Add New
                        </a>
                    </div>
                </div>
                <form method="post" action="#">
                    @csrf
                    <table id="" class="table table-bordered table-hover" style="width:100%;">
                        <thead>
                            <tr>
                                <th width=" 10px">#</th>
                                <th class="">Bank Name</th>
                                <th class="">NOC</th>
                                <th width="150px">Card #</th>
                                <th width="150px">CVV</th>
                                <th width="150px">Action</th>
                            </tr>
                        </thead>
                        <tbody class="">

                            @foreach ($result as $key => $result)
                                <tr>
                                    <td>
                                        <input type="hidden" name="sequence[]" value="{{ $result->id }}">
                                        {{ $key + 1 }}
                                    </td>
                                    <td> {{ $result->identifier }}</td>
                                    <td> {{ $result->ip }}</td>
                                    <td>
                                        @if ($result->is_primary)
                                            <span class="badge p-2 badge-success">Yes</span>
                                        @else
                                            <span class="badge p-2 badge-danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($result->status)
                                            <span class="badge p-2 badge-success">Enable</span>
                                        @else
                                            <span class="badge p-2 badge-danger">Disable</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- <a class="btn-primary btn-sm btn cursor-pointer"
                                            href="{{ route($folder_name . '-edit', ['id' => $result->e_id]) }}"> <i
                                                class="icon-edit"></i> </a>

                                        <a class="btn-danger btn-sm btn cursor-pointer"
                                            href="{{ route($folder_name . '-delete', ['id' => $result->e_id]) }}"> <i
                                                class="icon-trash"></i> </a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- <button type="submit" class="btn btn-sm mb-2 btn-success">
                        Update sequence
                    </button> --}}
                </form>
            </div>
        </div>
    </div>
</div>













<div class="modal fade" id="add_account_modal" tabindex="-1" role="dialog"
aria-labelledby="add_account_modal" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Account</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            @include('admin.customer_accounts.form', [
                'result' => [],
                'account' => null,
                'customer_id' => $result->id,
            ])
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
    </div>
</div>
</div>
@endsection