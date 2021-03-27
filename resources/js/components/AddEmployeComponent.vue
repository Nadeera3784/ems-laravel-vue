<template>
    <div class="row">
      <div class="col-md-12 mt-3">
         <div class="pull-left">
            <router-link :to="{ name: 'home' }" class="btn btn-primary" ><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</router-link>
         </div>
         <div class="pull-right">
             <h3>Employee</h3>
         </div>
         <div class="clearfix"></div>
      </div>

      <div class="col-md-12 mt-3">
        <div class="card">
          <div class="card-body">
            <form @submit.prevent="onSubmit">
              <div class="form-group">
                <label for="first_name">First name</label>
                <input type="text" class="form-control" :class="{ 'is-invalid': submitted && $v.employee.first_name.$error }" name="first_name" id="first_name" v-model="employee.first_name"/>
                <div v-if="submitted && !$v.employee.first_name.required" class="invalid-feedback">First name is required</div>
                <div v-if="submitted && !$v.employee.first_name.maxLength" class="invalid-feedback">First name cannot exceed 60 characters.</div>
              </div>
              <div class="form-group">
                <label for="last_name">Last name</label>
                <input type="text" class="form-control" :class="{ 'is-invalid': submitted && $v.employee.last_name.$error }" name="last_name" id="last_name" v-model="employee.last_name"/>
                 <div v-if="submitted && !$v.employee.last_name.required" class="invalid-feedback">Last name is required</div>
                 <div v-if="submitted && !$v.employee.last_name.maxLength" class="invalid-feedback">Last name cannot exceed 60 characters.</div>
              </div>
              <div class="form-group">
                <label for="middle_name">Middle name(Optional)</label>
                <input type="text" class="form-control" :class="{ 'is-invalid': submitted && $v.employee.middle_name.$error }" name="middle_name" id="middle_name"  v-model="employee.middle_name"/>
                 <div v-if="submitted && !$v.employee.middle_name.maxLength" class="invalid-feedback">Middle name cannot exceed 60 characters.</div>
              </div>
              <div class="form-group">
                <label for="address">Address</label>
                 <textarea class="form-control" :class="{ 'is-invalid': submitted && $v.employee.address.$error }" name="address" rows="3" id="address" v-model="employee.address"></textarea>
                 <div v-if="submitted && !$v.employee.address.required" class="invalid-feedback">Address is required</div>
                 <div v-if="submitted && !$v.employee.address.maxLength" class="invalid-feedback">Address name cannot exceed 120 characters.</div>
              </div>
              <div class="form-group">
                <label for="zip">Zip code</label>
                <input type="text" class="form-control" :class="{ 'is-invalid': submitted && $v.employee.zip.$error }" name="zip" id="zip" v-model="employee.zip">
                 <div v-if="submitted && !$v.employee.zip.required" class="invalid-feedback">Zip code is required</div>
                 <div v-if="submitted && !$v.employee.zip.maxLength" class="invalid-feedback">Zip code cannot exceed 10 characters.</div>
              </div>
          
              <div class="row">
                  <div class="col-md-3">
                      <div class="form-group">
                        <label for="department">Department</label>
                        <select class="form-control" :class="{ 'is-invalid': submitted && $v.employee.department.$error }" name="department" id="department" v-model="employee.department">
                          <option value="">--Select Department--</option>
                          <option v-for="i in departments" :value="i.id">{{ i.name }}</option>
                        </select>
                        <div v-if="submitted && !$v.employee.department.required" class="invalid-feedback">Department is required</div>
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="form-group">
                        <label for="state">State</label>
                        <select class="form-control" :class="{ 'is-invalid': submitted && $v.employee.state.$error }" name="state" id="state" v-model="employee.state">
                          <option value="">--Select State--</option>
                          <option v-for="i in states" :value="i.id">{{ i.name }}</option>
                        </select>
                        <div v-if="submitted && !$v.employee.state.required" class="invalid-feedback">State is required</div>
                      </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                        <label for="city">City</label>
                        <select class="form-control" :class="{ 'is-invalid': submitted && $v.employee.city.$error }" name="city" id="city" v-model="employee.city">
                          <option value="">--Select City--</option>
                          <option v-for="i in cities" :value="i.id">{{ i.name }}</option>
                        </select>
                        <div v-if="submitted && !$v.employee.city.required" class="invalid-feedback">City is required</div>
                      </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                        <label for="country">Country</label>
                        <select class="form-control" :class="{ 'is-invalid': submitted && $v.employee.country.$error }" name="country" id="country" v-model="employee.country">
                          <option value="">--Select Country--</option>
                          <option v-for="i in countries" :value="i.id">{{ i.name }}</option>
                        </select>
                        <div v-if="submitted && !$v.employee.country.required" class="invalid-feedback">Country is required</div>
                    </div>
                  </div>
              </div>

              <div class="form-group">
                <label for="birthdate">Birthdate(Optional)</label>
                <datepicker v-model="employee.birthdate" name="birthdate" id="birthdate" format="yyyy-MM-dd" input-class="form-control"></datepicker>
              </div>
              <div class="form-group">
                <label for="date_hired">Hired date(Optional)</label>
                <datepicker v-model="employee.date_hired" name="date_hired" id="date_hired" format="yyyy-MM-dd" input-class="form-control"></datepicker>
              </div>
              <button type="submit" class="btn btn-primary">Create</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</template>
<script>
    import Datepicker from 'vuejs-datepicker';
    import { required, maxLength } from 'vuelidate/lib/validators';
    const axios = require("axios");

    export default {
      components: {
        Datepicker
      },
      data() {
        return  {
          departments: [],
          states: [],
          countries: [],
          cities : [],
          employee: {
            birthdate: '',
            date_hired: '',
            first_name : '',
            last_name : '',
            middle_name : '',
            address : '',
            zip : '',
            department:'',
            state : '',
            city : '',
            country : '',
          },
          submitted: false
        }
      },
      validations: {
        employee: {
            first_name: { required , maxLength: maxLength(60)},
            last_name: { required , maxLength: maxLength(60)},
            middle_name: { maxLength: maxLength(60)},
            address: { required , maxLength: maxLength(120)},
            zip: { required , maxLength: maxLength(10)},
            department: { required},
            state: { required},
            city: { required},
            country: { required}
        }
      },
      methods: {
        async getDropDownData() {
            const { data } = await axios.get("/em/get-dropdown-data");
            this.departments = data.departments;
            this.states      = data.states;
            this.cities      = data.cities;
            this.countries   = data.countries;
        },

        onSubmit: function (e) {
          this.submitted = true;
          this.$v.$touch();
          if (this.$v.$invalid) {
              return;
          }else{
            axios.post('/em/employee/store-employee', this.employee).then((response) => {
              this.$alert(response.data.message, 'success', 'success');
              e.target.reset();
            }, 
            (error) => {
              this.$alert(response.data.message, 'error', 'error');
            }); 
          }
        }
      },
      beforeMount() {
          this.getDropDownData();
      }
    }
</script>