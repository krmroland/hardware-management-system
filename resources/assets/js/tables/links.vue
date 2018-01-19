<template>
    <nav>
        <span>
            showing up to
            {{ paginator.uptoItems|currency }}
            results out of
            {{ paginator.totalItems|currency }}
        </span>
      <ul class="pagination justify-content-end" v-if="paginator.shouldPaginate">
        <li class="page-item" :class="{'disabled':paginator.onFirstPage}">
          <a class="page-link" href="#" aria-label="Previous" @click="--paginator.currentPage">
            <span aria-hidden="true">&laquo;</span>
            <span>Previous</span>
          </a>
        </li>
        <template v-for="link in paginator.links">
            <li class="page-item " :class="stateClass(link)">
                <a class="page-link" href="#" @click.prevent="paginator.currentPage=link">{{ link }}</a>
            </li>
        </template>
       
        <li class="page-item" :class="{'disabled':paginator.onLastPage}">
          <a class="page-link" href="#" aria-label="Next" @click.prevent="++paginator.currentPage">
            <span aria-hidden="true">&raquo;</span>
            <span>Next</span>
          </a>
        </li>
      </ul>
    </nav>
</template>

<script>
import {range} from "lodash";

    export default
    {
        props:["paginator"],

        methods:{
            stateClass(link)
            {
              
                if (typeof link =='string') {
                    return 'disabled';
                }
                if (link==this.paginator.currentPage) {
                    return 'active';
                }
            }
        }
    }
</script>
