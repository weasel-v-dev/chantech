<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Admin dashboard</div>

                    <div class="card-body">
                        <ReviewsImport />
                    </div>
                </div>
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
