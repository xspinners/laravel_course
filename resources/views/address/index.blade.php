<x-app-layout>
<x-slot name="header"><img src="{{ asset('img/image.png') }}">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Address') }}
        </h2> <a class="btn" href="{{route('orders.create')}}">New Order</a>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
    
                {{ Form::select('user_id', ['Please select'=>''] + $users->toArray(),null,['id'=>'user_id'])}}<br>
                {{ Form::select('address_id', [], null, ['id'=>'address_id','required','class'=>'form-control'])}}
                </div>
            </div>
        </div>
    </div>
@section('script')
<script>
    $(document).ready(function(){
        $('#user_id').change(function(){
            $.ajax({
                url: '{{ route('address.byuser')}}',
                data: { user: $('#user_id').val()},
                success: function(response)
                {
                    $('#address_id').find('option').remove().end();
                    if(response.addresses.length > 1)
                    {
                        $.each(response.addresses, function(index, data){
                            
                            $('#address_id').append($("<option></option>").attr("value", data.id).text(data.full_address));
                        })
                    }
                }
            });
        });
    });
</script>
@endsection
</x-app-layout>