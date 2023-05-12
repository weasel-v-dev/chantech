<template>
    <div>
        <v-file-input
            accept="csv/*"
            label="File input"
            v-model="file"
        ></v-file-input>
        <v-alert v-if="errors.length"
                 v-for="error in errors"
                 color="error"
                 icon="$error"
                 :title="error"
        ></v-alert>
        <br>
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
            readyArr: []
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
                    const lines = result.split('\n')
                    const header = lines[0].split(',')
                    const output = lines.slice(1).map(line => {
                        const fields = line.replace(/"/g, '').split(',')
                        const json = Object.fromEntries(header.map((h, i) => [this.cleanNamesColumns(h), fields[i]]));
                        json.reviewer = json.reviewer ?? '';
                        json.email = json.email ?? '';
                        json.review = json.review ?? '';
                        json.rating = json.rating ?? '';
                        json.employee = json.employee ?? '';
                        return json;
                    });

                    console.log(output[output.length - 1]);

                    this.errors = this.validColumn(output[0]);

                    if(!this.errors.length) {
                        this.readyArr = output;
                    }
                },
                error => {
                    console.log(error);
                }
            );
        }
    },
    methods: {
        cleanNamesColumns(columns) {
            return columns.replace(/\s+/, '_').replace(/"/g, '').toLowerCase()
        },
        validColumn(fistRow) {
            let res = [];

            const importantFields = ['reviewer', 'email', 'review', 'rating', 'employee', 'employees_position', 'unique_employee_number', 'company', 'company_description'];

            for(const nameColumn in fistRow ){
                let findField = '';
                importantFields.forEach((importantField) => {
                    if(importantField === nameColumn) {
                        findField = importantField;
                        return false;
                    }
                })
                if(findField === '') {
                    res.push(nameColumn + ' is wrong field');
                }
            }
            return res;
        },
        send() {
            axios.post('distribution', {
                data: this.readyArr
            }, {
                'Content-Type': 'application/json'
            }).then((res) => {
                console.log(res.data)
            }).catch((res) => {
                console.log(res)
            })
        }
    }
}
</script>

<style scoped>

</style>
