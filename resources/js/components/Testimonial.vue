<template>
    <v-app class="kh-bg">
        <div class="d-flex align-items-center flex-column">
            <div class="d-flex flex-wrap khantech-row" v-if="testimonials.length">
                <div
                    v-for="item in testimonials"
                    class="mb-3 p-3 khantech-col"
                    :key="item.id"
                >
                    <div class="testimonial p-3 mb-5">
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
                                color="orange"
                                dense
                                background-color="orange"
                                half-increments
                                readonly
                            ></v-rating>
                        </div>
                    </div>
                </div>
            </div>
            <v-progress-linear
                v-if="showProgress "
                indeterminate
                color="cyan"
                purple
                rounded
                class="mb-3"
            ></v-progress-linear>
            <v-pagination
                v-if="testimonials.length"
                v-model="page"
                :length="calcPaginationElements"
                :total-visible="7"
                @next="getTestimonials"
                @previous="getTestimonials"
                @input="getTestimonials"
                circle
                background--primary
                background--blue
                class=" background--primary background--blue"
            ></v-pagination>
        </div>
    </v-app>
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
            showProgress: true,
            page: 1,
            count: 0
        }
    },
    mounted() {
        this.getTestimonials();
    },
    computed: {
        calcPaginationElements() {
            return Math.floor(this.count / 15) + 1;
        }
    },
    methods: {
        getResults(e) {
            this.getTestimonials()
        },
        getTestimonials() {
            this.showProgress = true;
            const self = this;
            console.log('click', self.page);
            axios.get('/testimonial', {params: {page : self.page, total : 15 }}).then((res) => {
                this.testimonials = res.data.testimonials;
                this.count = res.data.count;
                this.showProgress = false;
            }).catch((err) => {
                this.showProgress = false;
            });
        }
    }
}
</script>

<style scoped lang="scss">
    @import "../../sass/elements/grid";
    @import "../../sass/sections/testimonial";

    ::v-deep {
        .v-application--wrap {
            min-height: fit-content;
        }
        .v-pagination {
            &__item, &__navigation {
                border: 1px solid #0880AE;
                height: 40px;
                width: 40px;
                color: #727272;
                font-size: 14px;
            }
        }
    }
    .theme--light.v-application {
        background-color: transparent;
    }


</style>
