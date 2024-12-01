<!-- resources/views/orders.blade.php -->
@extends('layouts.app')

@section('content')
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Details</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->location }} - {{ $order->size }} - {{ $order->weight }}</td>
            <td>{{ $order->status }}</td>
            <td>
                <form method="POST" action="/orders/{{ $order->id }}/status">
                    @csrf
                    @method('PUT')
                    <select name="status">
                        <option value="pending">Pending</option>
                        <option value="in_progress">In Progress</option>
                        <option value="delivered">Delivered</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
