{{ Form::text('order_date')}}<br>
{{ Form::select('status',config('myapp.order.status'),null)}}<br>
{{ Form::select('address_id',\App\Models\Address::get()->pluck('full_address','id'),null)}}<br>
                    
<button type="submit">Submit</button>