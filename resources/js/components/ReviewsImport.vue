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
            @click="cut"
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
                    const self = this;
                    const lines = result.split('\n')
                    const header = lines[0].split(',')
                    const output = lines.slice(1).map(line => {
                        const fields = line.split(',')
                        return Object.fromEntries(header.map((h, i) => [this.cleanNamesColumns(h), fields[i]]))
                    });

                    this.errors = this.validColumn(output[0]);
                    if(!this.errors.length) {

                        // let json = [];
                        // for (const prop of output) {
                        //     // if(output.hasOwnProperty(prop)) {
                        //     console.log('prop', );
                        //         let obj = {};
                        //         obj[this.cleanNamesColumns(Object.keys(prop))] = Object.values(prop)
                        //         json.push(obj);
                        //     console.log(json)
                        //         return false;
                        //     // }
                        // }

                        console.log('output', output)
                        // console.log('json', json)

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
        send(url, arr) {
            axios.post(url, {
                data: arr
            }, {
                'Content-Type': 'application/json'
            }).then((res) => {
                console.log(res.data)
            }).catch((res) => {
                console.log(res)
            })
        },
        cut() {
            this.send('/position', this.readyArr.map((el) => {
                return {
                    employees_position: el.employees_position,
                    unique_employee_number: el.unique_employee_number
                }
            }));
            this.send('/company', this.readyArr.map((el) => {
                return {
                    company: el.company,
                    company_description: el.company_description
                }
            }));
            this.send('/reviewer', this.readyArr.map((el) => {
                return {
                    reviewer: el.reviewer,
                    email: el.email
                }
            }));
            this.send('/employee', this.readyArr.map((el) => {
                return {
                    employee: el.employee
                }
            }));
            this.send('/review', this.readyArr.map((el) => {
                return {
                    review: el.review,
                    rating: el.rating
                }
            }));
        }
    }
}
</script>

<style scoped>

</style>
