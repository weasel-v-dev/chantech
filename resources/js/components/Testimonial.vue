<template>
    <div>
        <div class="d-flex flex-wrap khantech-row">
            <div
                v-if="testimonials.length"
                v-for="item in testimonials"
                class="mb-3  p-3 khantech-col"
                :key="item.id">
                <div class="testimonial p-3 mb-3">
                    <h3 class="middle">{{item.name}}</h3>
                    <p class="small">{{item.company}} - {{item.position}}</p>
                    <p class="mb-0 middle">
                        {{item.desc}}
                    </p>
                    <div class="triangle"></div>
                </div>
                <div class="d-flex">
                    <div class="me-3">
                        <img src="/img/icons/avatar.svg" class="" alt="">
                    </div>
                    <div>
                        <div class="middle">{{ item.reviewerName }}</div>
                        <v-rating
                            v-model="item.rating"
                            color="gold"
                            dense
                            background-color="gold"
                            half-increments
                            readonly
                        ></v-rating>
                    </div>
                </div>
            </div>
            <v-progress-linear

                indeterminate
                color="cyan"
                purple
                rounded
            ></v-progress-linear>
        </div>
        <v-pagination
            v-model="page"
            :length="15"
            :total-visible="7"
            @next="getTestimonials"
            @previous="getTestimonials"
            @input="getTestimonials"
            circle
        ></v-pagination>
    </div>
</template>

<script>
import Pagination from 'vue-pagination-2';

export default {
    components: {
        Pagination
    },
    data() {
        return {
            testimonials: [],
            a: false,
            page: 1,
            total: 0
        }
    },
    mounted() {
        this.getTestimonials();
    },
    computed: {
        calcTotal() {
            return Math.floor(this.total / 15);
        }
    },
    methods: {
        getResults(e) {
            this.getTestimonials()
        },
        getTestimonials() {
            const self = this;
            console.log('click', self.page);
            axios.get('/testimonial', {params: {page : self.page, total : self.total }}).then((res) => {
                this.testimonials = res.data.testimonials;
                this.total = res.data.count;
            });
        }
    }
}
</script>

<style scoped lang="scss">
    @import "../../sass/elements/grid";
    @import "../../sass/sections/testimonial";
</style>
