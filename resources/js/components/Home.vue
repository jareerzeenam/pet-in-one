<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 mt-3">
        <div class="card text-center">
          <div class="card-header">
              <h2>Welcome Home</h2>
          </div>

          <div class="card-body">
              <div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img class="d-block w-100" src="images/slider/1.jpg" alt="">

                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="images/slider/2.jpg" alt="">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="images/slider/3.jpg" alt="">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="images/slider/4.jpg" alt="">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="images/slider/5.jpg" alt="">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="images/slider/6.jpg" alt="">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="images/slider/7.jpg" alt="">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
