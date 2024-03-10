<x-layout>   
    <div class="container">
        <div class="col-12">
            <form action="{{ route('label.make', $companyId) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="order_number">Order nr.</label>
                    <input type="text" name="order_number" value="958201" class="form-control">
                    @if($errors->first('order_number'))
                        <div class="alert alert-danger" role="alert">
                            <span class="error">{{$errors->first('order_number')}}</span>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="weight">Gewicht</label>
                    <input type="text" name="weight" class="form-control">
                    @if($errors->first('weight'))
                        <div class="alert alert-danger" role="alert">
                            <span class="error">{{$errors->first('weight')}}</span>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="brand">Brand</label>
                    <select name="brand" class="form-control">
                        @foreach($brands["data"] as $brand)
                        <option value="{{$brand['id']}}">{{$brand['name']}}</option>
                        @endforeach
                    </select>
                    @if($errors->first('brand'))
                        <div class="alert alert-danger" role="alert">
                            <span class="error">{{$errors->first('brand')}}</span>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="product">Product</label>
                    <select name="product" class="form-control">
                        @foreach($products["data"] as $product)
                        <option value="{{$product["id"]}}" disabled>
                            {{$product["name"]}}
                        </option>
                        @endforeach
                        <option value="2">DHL Pakje (NL)</option>
                    </select>
                    @if($errors->first('product'))
                        <div class="alert alert-danger" role="alert">
                            <span class="error">{{$errors->first('product')}}</span>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="combinations">Combinatie</label>
                    <select name="combination" class="form-control">
                        <option value="1" disabled>DHL Pakje zonder opties</option>
                        <option value="2" disabled>DHL Pakje (NL) without delivery options</option>
                        <option value="3">DHL Brievenbuspakje zonder opties)</option>
                    </select>
                    @if($errors->first('combination'))
                        <div class="alert alert-danger" role="alert">
                            <span class="error">{{$errors->first('combination')}}</span>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="form-control">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
