@extends('home.app')

@section('content')
<div class="container">
    <h1>Create Pembayaran</h1>

    <form method="post" action="{{ route('pembayaran.store') }}">
        @csrf
        <div class="form-group">
            <label for="payer_email">Payer Email</label>
            <input type="email" class="form-control" id="payer_email" name="payer_email" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" required>
        </div>
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" class="form-control" id="amount" name="amount" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
