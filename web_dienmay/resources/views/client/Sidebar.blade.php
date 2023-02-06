
<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products"><!--category-productsr-->
          @foreach($category as $value)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="{{route('client-category',$value->slug)}}">{{$value->title}}</a></h4>
                </div>
            </div>
            @endforeach
        </div>

        <div class="brands_products"><!--brands_products-->
            <h2>Brands</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    @foreach($brand as $value)
                    <li><a href="{{route('client-brand',$value->slug)}}"> {{$value->title}}</span></a></li>
                    @endforeach
                </ul>
            </div>
        </div><!--/brands_products-->

    </div>
</div>
