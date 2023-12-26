@extends('layouts.app')


@section("content")
    <div class="container">
        <form id="add-sale" action="{{ route("payments.store") }}" method="post">
            @csrf
          
            <div class="row justify-content-center mt-2">
                <div class="col-md-12 card p-3">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        @foreach ($categories as $category)
                            <li class="nav-item">
                                <a href="#{{ $category->slug }}"
                                    class="nav-link mr-1 {{ $category->slug === "salades-marocaines" ? "active" : "" }}"
                                    id="{{ $category->slug }}-tab"
                                    data-toggle="pill"
                                    role="tab"
                                    aria-controls="{{ $category->slug }}"
                                    aria-selected="true"
                                >
                                    {{ $category->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="pills-tabcontent">
                        @foreach ($categories as $category)
                            <div class="tab-pane fade {{ $category->slug === "salades-marocaines" ? "show active" : "" }}"
                                id="{{ $category->slug }}"
                                role="tabpanel"
                                aria-labelledby="pills-home-tab"
                                >
                                <div class="row">
                                    @foreach($category->foods as $menu)
                                        <div class="col-md-4 mb-2">
                                            <div class="card h-100">
                                                <div class="card-body d-flex
                                                flex-column justify-content-center
                                                align-items-center">
                                                    <div class="align-self-end">
                                                        <input type="checkbox" name="menu_id[]"
                                                            id="menu_id"
                                                            value="{{ $menu->id }}"
                                                        >
                                                    </div>
                                                    <img
                                                        src="{{ asset("images/menus/". $menu->image) }}" alt="{{ $menu->title}}"
                                                        class="img-fluid rounded-circle"
                                                        width="100"
                                                        height="100"
                                                    >
                                                    <h5 class="font-weight-bold mt-2">
                                                        {{ $menu->title }}
                                                    </h5>
                                                    <h5 class="text-muted">
                                                        {{ $menu->price }} Php
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <div class="form-group">
                                <select name="employee_id" class="form-control">
                                    <option value="" selected disabled>
                                        Employee
                                    </option>
                                    @foreach ($servants as $servant)
                                        <option value="{{ $servant->id }}">
                                            {{ $servant->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Quantity
                                    </div>
                                </div>
                                <input type="number"
                                    name="quantity"
                                    class="form-control"
                                    placeholder="Quantity"
                                >
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        $
                                    </div>
                                </div>
                                <input type="number"
                                    name="total_price"
                                    class="form-control"
                                    placeholder="Price"
                                >
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        .00
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        $
                                    </div>
                                </div>
                                <input type="number"
                                    name="total_received"
                                    class="form-control"
                                    placeholder="Total"
                                >
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        .00
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        $
                                    </div>
                                </div>
                                <input type="number"
                                    name="change"
                                    class="form-control"
                                    placeholder="Reste"
                                >
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        .00
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <select name="payment_type" class="form-control">
                                    <option value="" selected disabled>
                                        Type of payment
                                    </option>
                                    <option value="cash">
                                        Cash
                                    </option>
                                    <option value="card">
                                        Card
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="payment_status" class="form-control">
                                    <option value="" selected disabled>
                                        State of payment
                                    </option>
                                    <option value="paid">
                                        Paid
                                    </option>
                                    <option value="unpaid">
                                        Unpaid
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button
                                    onclick="event.preventDefault();
                                        document.getElementById("add-sale").submit();
                                    "
                                    class="btn btn-primary"
                                >
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section("javascript")
    <script>
        function print(el){
            const page = document.body.innerHTML;
            const content = document.getElementById(el).innerHTML;
            document.body.innerHTML = content;
            window.print();
            document.body.innerHTML = page;
        }
    </script>
@endsection
