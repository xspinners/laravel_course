<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2> <a class="btn" href="{{route('orders.create')}}">New Order</a>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table id="tbl_orders" style="width:100%">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Date</td>
                        <td>Address</td>
                        <td>Status</td>
                        <td>Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@section('script')
<script>
    $(document).ready(function(){
        $('#tbl_orders').DataTable({
            ajax: '{{ route('orders.datatable') }}',
            columns: [
                {
                    data: 'id'
                },
                {
                    data: 'order_date'
                },
                {
                    data: 'address'
                },
                {
                    data: 'status'
                },
                {
                    data: 'action',
                    // render: function ( data, type, row, meta ) {
                    //     return data.action;
                    // }
                }
            ]
        });
    });
</script>
@endsection
</x-app-layout>
