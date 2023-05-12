<template>
    <div>
        <h1 v-if="a">Testimonial</h1>

            <TransitionGroup name="list" class="d-flex flex-wrap" tag="div">
                <v-card
                v-for="item in testimonials"
                class="mx-auto mb-3"
                max-width="344"
                :key="item.id"
            >
                <v-card-text>
                    <div>{{item.name}}</div>
                    <p class="text-h4 text--primary">
                        {{item.company}}
                    </p>
                    <p>{{item.position}}</p>
                    <div class="text--primary">
                        {{item.desc}}
                    </div>
                    <p>
                        {{item.reviewerName}}
                    </p>
                    <v-rating
                        v-model="item.rating"
                        color="yellow darken-3"
                        background-color="grey darken-1"
                        empty-icon="$ratingFull"
                        half-increments
                        hover
                        large
                    ></v-rating>
                </v-card-text>
            </v-card>
            </TransitionGroup>
        <v-pagination
            v-model="page"
            :length="total"
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
            total: 15
        }
    },
    mounted() {
        this.getTestimonials();
    },
    methods: {
        getResults(e) {
            this.getTestimonials()
        },
        getTestimonials(page = 1, total = 15) {
            const self = this;
            // this.testimonials = [];
            axios.get('/testimonial', {params: {page : self.page, total : self.total }}).then((res) => {
                this.testimonials = res.data.testimonials;
            });
        }
    }
}
</script>

<style scoped>
.list-enter-active,
.list-leave-active {
    transition: all 0.5s ease;
}
.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateX(30px);
}
</style>
