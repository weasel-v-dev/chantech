<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <v-app class="lighten-5">
                    <v-content >
                        <v-card
                            class="mx-auto"
                        >
                            <v-img
                                class="white--text align-end"
                                height="200px"
                                src="https://cdn.vuetifyjs.com/images/parallax/material.jpg"
                            >
                            </v-img>

                            <v-card-text class="text--primary">
                                <ReviewsImport />
                            </v-card-text>
                        </v-card>
                    </v-content>
                </v-app>
            </div>
        </div>
    </div>
</template>

<script>
    import ReviewsImport from '../components/ReviewsImport'

    export default {
        components: {
            ReviewsImport
        }
    }
</script>
<!--<template>-->
<!--    <div >-->
<!--        <h1 v-if="a">Testimonial</h1>-->
<!--        <div >-->
<!--            <div v-for="item in testimonials">-->
<!--                <h2>{{item.name}}</h2>-->
<!--            </div>-->
<!--            <button @click="a = !a">aaa1</button>-->
<!--        </div>-->
<!--    </div>-->
<!--</template>-->

<!--<script>-->

<!--export default {-->
<!--    data() {-->
<!--        return {-->
<!--            testimonials: [],-->
<!--            a: false-->
<!--        }-->
<!--    },-->
<!--    mounted() {-->
<!--        this.getTestimonials();-->
<!--    },-->
<!--    methods: {-->
<!--        scrollDown(e) {-->
<!--            console.log(this.reviews)-->
<!--            if (e.target.scrollTop + e.target.clientHeight === e.target.scrollHeight) {-->
<!--                this.getTestimonials()-->
<!--            }-->
<!--        },-->
<!--        getTestimonials(count = 15) {-->
<!--            axios.get('/testimonial/'+count).then((res) => {-->
<!--                this.testimonials = res.data.testimonials;-->
<!--                console.log(res.data.testimonials);-->
<!--            });-->
<!--        }-->
<!--    }-->
<!--}-->
<!--</script>-->

<!--<style scoped>-->

<!--</style>-->

