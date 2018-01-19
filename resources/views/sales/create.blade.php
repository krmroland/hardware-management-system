@extends('layouts.app')
    @section('content')
        {{--  <make-purchase :data="{{ $data }}"></make-purchase> --}}
         <product-transaction
            :transaction-data="{{ $data }}" 
            title="Create A New Sale"
            action="{{ route('sales.store') }}"
            icon="icon-shopping-basket"
            button-text="Make &amp; Persist This Sale"
            client-name="Customer"
            :price-mappings="{buyingPrice:'Bought At',sellingPrice:'Sold At'}"
        ></product-transaction>
    @endsection

