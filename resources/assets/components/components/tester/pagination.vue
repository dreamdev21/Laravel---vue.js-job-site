<template>
  <div class="row">
    <div class="col-12 text-center">
      <span>{{pagination_text}}</span>
      <nav aria-label="">
        <ul class="pagination custom-pagination">
          <li class="page-item" >
            <a class="page-link" href="javascript:;" aria-label="Previous" @click="prevPage">
              <span aria-hidden="true">
                <img src="~img/pagination-prev.png" class="ing-fluid"/>
              </span>
              <span class="sr-only">Previous</span>
            </a>
          </li>
          <li :class="['page-item ', page == currentPage ? 'active' : '' ]" v-for="page in noOfPages" :key="page" @click.prevent="getPageData(page)" >
            <a class="page-link" href="javascript:;">{{ page }}</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="javascript:;" aria-label="Next" @click="nextPage">
              <span aria-hidden="true">
                <img src="~img/pagination-next.png" class="ing-fluid"/>
              </span>
              <span class="sr-only">Next</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
  name: "pagination",
  props: {
    noOfPages:{
      type: Number,
      required: true
    },
    currentPage:{
      type: Number,
      required: true
    },
    perPage: {
      type: Number,
      required: true
    },
    totalNoOfRecords:{
      type: Number,
      required: true
    }
  },
  methods:{
    getPageData(page){
      this.$emit("getPageData", page);
    },
    nextPage(){
      let nextPage = this.currentPage;
      nextPage++;
      if(nextPage <= this.noOfPages)
        this.$emit('update-current-page', nextPage);
    },
    prevPage(){
      let prevPage = this.currentPage;
      prevPage--;
      if(prevPage > 0 )
        this.$emit('update-current-page', prevPage);
    }
  },
  computed: {
    pagination_text: function() {
      let startNo = 0, endNo = 0, totalNo = 0, currentPageNo = this.currentPage;
      startNo = (currentPageNo*this.perPage) - this.perPage;
      endNo = startNo+this.perPage;
      if(currentPageNo == this.noOfPages) { endNo = this.totalNoOfRecords }
      return 'Showing from '+ (startNo==0 ? 1 : startNo+1 ) +' to '+ endNo +' from '+ this.totalNoOfRecords;
    }
  }
}
</script>

<style lang="scss" scoped>
  @import "../../layouts/css/_customvariables";
 .custom-pagination{
    // max-width: 300px;
    margin: 10px auto 0;
    display: block;
    width: auto;
    .page-item{
      margin-right: 3px;
      display: inline-block;
      .page-link{
        padding: 10px 15px;
        font-size: 16px;
        color: #606368;
        font-family: $font-family-brandon-bold !important;
       
      }
      &:first-child{
        .page-link{
          border-top-left-radius: 30px;
          border-bottom-left-radius: 30px;
          line-height: 20px;
        }
      }
      &:last-child{
        .page-link{
          border-top-right-radius: 30px;
          border-bottom-right-radius: 30px;
          line-height: 20px;
        }
      }
    }
    .page-item.active{
      .page-link{
      background-color: #2cac3d;
      border-color: #2cac3d;
      color: #fff;
    }
    }
  }
  @media screen and(max-width:575px) {
    .custom-container{
      .custom-pagination{
        // max-width: 230px;
          li{
            .page-link{
              padding: 5px 10px;
            }
          }
      }
    }
  }

</style>