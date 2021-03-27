<template>

    <div class="row">
      <div class="col-md-12 mt-3">
         <div class="pull-left"><h3>Employee</h3></div>
         <div class="pull-right">
              <router-link :to="{ name: 'create' }" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> New Employee</router-link>
         </div>
         <div class="clearfix"></div>
      </div>
      <div class="col-md-12 mt-3">
        <vuetable-pagination-info ref="paginationInfo"></vuetable-pagination-info>

        <vuetable ref="vuetable"
            api-url="http://127.0.0.1:8000/em/get-employee-list"
            :fields="fields"
            :sort-order="sortOrder"
            :css="css.table"
            pagination-path=""
            :per-page="perPage"
            :options="tableoptions"
            @vuetable:pagination-data="onPaginationData"
            >

            <div slot="action-slot" slot-scope="props">
                <router-link class="btn btn-primary btn-sm" :to="{name:'update',params:{id:props.rowData.id} }"><span class="fa fa-pencil"></span> Edit</router-link>
                <button class="btn btn-danger btn-sm" @click="deleteRow(props.rowData.id)"><span class="fa fa-trash"></span> Delete</button>
            </div>
        </vuetable>

        <vuetable-pagination ref="pagination"
          :css="css.pagination"
          @vuetable-pagination:change-page="onChangePage"
        >
        </vuetable-pagination>

      </div>
   </div>

</template>

<script>

    import Vuetable from 'vuetable-2';
    import VuetablePagination from 'vuetable-2/src/components/VuetablePagination';
    import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo';
    import VuetableFieldSequence from 'vuetable-2/src/components/VuetableFieldSequence.vue';
    const axios = require("axios");

    export default {
        components: {
            Vuetable,
            VuetablePagination,
            VuetablePaginationInfo,
            VuetableFieldSequence
        },
        data() {
            return  {
                fields: [
                   {
                    name: VuetableFieldSequence,
                    title: "No.",
                    width: "5%"
                   },
                   { 
                    name: 'first_name', 
                    title: 'First Name',
                    sortField: 'first_name'
                   }, 
                   { 
                    name: 'last_name', 
                    title: 'Last Name',
                    sortField: 'last_name'
                   },
                   { 
                    name: 'department_id.name', 
                    title: 'Department',
                    sortField: 'department_id.name'
                   },
                   { 
                    name: 'country_id.name', 
                    title: 'Country',
                    sortField: 'country_id.name'
                   },
                   { 
                    name: 'city_id.name', 
                    title: 'City',
                    sortField: 'city_id.name'
                    },
                    {
                      name: "action-slot",  
                      title: 'Actions',
                      titleClass: "center aligned",
                      dataClass: "center aligned",
                      width: "15%"
                    }
                ],
                sortOrder: [
                  { field: 'first_name', direction: 'asc' }
                ],
                perPage: 5,
                css: {
                      table: {
                        tableClass: 'table table-hovered',
                        loadingClass: 'loading',
                        ascendingIcon: 'glyphicon glyphicon-chevron-up',
                        descendingIcon: 'glyphicon glyphicon-chevron-down',
                        handleIcon: 'glyphicon glyphicon-menu-hamburger',
                      },
                      pagination: {
                        infoClass: 'pull-left',
                        wrapperClass: 'vuetable-pagination pull-right',
                        activeClass: 'btn-primary',
                        disabledClass: 'disabled',
                        pageClass: 'btn btn-border',
                        linkClass: 'btn btn-border',
                        icons: {
                          first: '',
                          prev: '',
                          next: '',
                          last: '',
                        },
                      }
                },
                searchTerm: '',
                tableoptions: {
                customFilters: [{
                  name: 'mysearch',
                  callback: function(row, query) {
                    //this should be updated to match your data objects
                    return row.name[0] == query; 
                  }
                }]
              },
            }
        },
        methods: {
            onPaginationData (paginationData) {
              this.$refs.pagination.setPaginationData(paginationData);
              this.$refs.paginationInfo.setPaginationData(paginationData);
            },
            onChangePage (page) {
              this.$refs.vuetable.changePage(page)
            },
            editRow(rowData){
              alert("You clicked edit on"+ JSON.stringify(rowData))
            },
            deleteRow(rowData){
              this.$confirm("Are you sure you want to delete this?", 'Confirm', 'question')
              .then((result) => {
                axios.post('/em/employee/delete/'+rowData, {}).then((response) => {
                  this.$alert(response.data.message, 'success', 'success');
                  this.$refs.vuetable.refresh();
                }, 
                (error) => {
                  this.$alert(response.data.message, 'error', 'error');
                }); 
              })
              .catch((error) => {

              });
            },
            onLoading() {
              console.log('loading... show your spinner here')
            },
            onLoaded() {
              console.log('loaded! .. hide your spinner here')
            },
            filterResult() {
              this.$refs.vuetable.$emit('vue-tables.filter::mysearch', query);
            }
        },
        watch: {

        },

    }
</script>
