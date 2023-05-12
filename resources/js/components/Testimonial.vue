<template>
    <div>
        <h1 v-if="a">Testimonial</h1>
        <div >
            <div v-for="item in testimonials">
                <h2>{{item }}</h2>
            </div>
            <button @click="a = !a">aaa1</button>
        </div>
        <v-pagination
            v-model="page"
            :length="total"
            :total-visible="6"
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
            this.testimonials = [];
            axios.get('/testimonial', {params: {page : self.page, total : self.total }}).then((res) => {
                this.testimonials = res.data.testimonials;
            });
        }
    }
}
</script>

<style scoped>

</style>
