<x-layout>   
   <div class="container">
      <h2>Create label for:</h2>
      @foreach($companies['data'] as $company)
      <a href="{{route('label.create', $company["id"])}}">{{$company["name"]}}</a>
      @endforeach
   </div>
</x-layout>
