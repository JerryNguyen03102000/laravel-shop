<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner">
                        <div class="item active">
                            <img style="margin-left: 0;width: 100%;height: 400px" src="https://www.nhatminhlaptop.vn/Upload/images/ProductCategories/banner-macbook-1.jpg?v=1" alt="error_image">
                        </div>
                        @foreach($slider as $value)

                            <div class="item ">
                                <div class="col-sm-12">
                                    <img style="margin-left: 0;width: 100%;height: 400px" src="upload/slider/{{$value->image}}" alt="error_image">
                                </div>
                            </div>
                        @endforeach



                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->
