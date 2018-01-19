@extends('layouts.app')
    @section('content')
        {{--  <make-purchase :data="{{ $data }}"></make-purchase> --}}
         <product-transaction
            :transaction-data="{{ $data }}" 
            title="Create A New Purchase"
            action="{{ route('purchases.store') }}"
            icon="icon-shopping-basket"
            button-text="Make &amp; Persist Purchase"
            client-name="Supplier"
            :price-mappings="{buyingPrice:'Bought At',sellingPrice:'Will Sell At'}"
        ></product-transaction>
    @endsection

