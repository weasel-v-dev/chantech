<template>
    <div>
        <v-file-input
            accept="csv/*"
            label="File input"
            v-model="file"
        ></v-file-input>
        <div class="error" v-if="errors.length">
            <div v-for="error in errors">{{error}}</div>
        </div>
        <v-btn
            elevation="2"
            dark
            x-large
            color="purple"
            block
            @click="send"
        >
            IMPORT
        </v-btn>
    </div>
</template>

<script>
export default {
    data() {
        return {
            file: [],
            errors: [],
            jsonCsv: []
        }
    },
    watch: {
        file() {
            let promise = new Promise((resolve, reject) => {
                var reader = new FileReader();
                var vm = this;
                reader.onload = e => {
                    resolve((vm.fileinput = reader.result));
                };
                reader.readAsText(this.file);
            });

            promise.then(
                result => {
                    const lines = result.split('\n') // 1️⃣
                    const header = lines[0].split(',') // 2️⃣
                    const output = lines.slice(1).map(line => {
                        const fields = line.split(',') // 3️⃣
                        return Object.fromEntries(header.map((h, i) => [h, fields[i]])) // 4️⃣
                    });

                    this.errors = this.validCsv(output[0]);
                    if(!this.errors.length) {
                        this.jsonCsv = output;
                    }
                },
                error => {

                    console.log(error);
                }
            );
        }
    },
    methods: {
        validCsv(o) {
            let properties = [];
            let res = [];

            for (const prop in o) {
                properties.push(prop.replace(/\s+/, '_')
                    .replace(/"/g, '').toLowerCase()
                );
            }

            const importantFields = ['reviewer', 'email', 'review', 'rating', 'employee', 'employees_position', 'unique_employee_number', 'company', 'company_description'];

            properties.forEach((property) => {
                let findField = '';
                importantFields.forEach((importantField) => {
                    if(importantField === property) {
                        findField = importantField;
                        return false;
                    }
                })
                if(findField === '') {
                    res.push(property + ' is wrong field');
                }
            })

            return res;

        },
        send() {
            if(this.jsonCsv.length) return false;
            console.log(this.jsonCsv);
        }
    }
}
</script>

<style scoped>

</style>
