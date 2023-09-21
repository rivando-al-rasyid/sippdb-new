@extends('depan.app')

@section('content')
    <div class="container">
        <h1>Pembayaran List</h1>
        <div class="mb-2">
            <a href="{{ route('pembayaran.create') }}" class="btn btn-primary">Create Pembayaran</a>
        </div>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>External ID</th>
                    <th>Payer Email</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Link</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembayaran as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->external_id }}</td>
                        <td>{{ $p->payer_email }}</td>
                        <td>{{ $p->description }}</td>
                        <td>{{ $p->amount }}</td>
                        <td>{{ $p->status }}</td>
                        <td>
                            <button type="button" class="btn btn-primary"
                                onclick="window.open('{{ $p->checkout_link }}', '_blank')">
                                Open Link in New Tab
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
