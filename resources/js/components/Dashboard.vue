<template>
    <div class="container">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-8">
                <v-app class="lighten-5">
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
                </v-app>
            </div>
        </div>
    </div>
</template>
<script>
    import ReviewsImport from '../UI/ReviewsImport'

    export default {
        components: {
            ReviewsImport
        }
    }
</script>
<style scoped>
::v-deep .v-application--wrap {
    min-height: fit-content;
}
</style>

