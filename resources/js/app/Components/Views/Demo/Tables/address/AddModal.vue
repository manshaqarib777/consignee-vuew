<template>
    <modal :modal-id="modalId"
                     :title="modalTitle"
                     :preloader="preloader"
                     @submit="submit"
                     @close-modal="closeModal">
        <template slot="body">
            <app-overlay-loader v-if="preloader"/>
            <form class="mb-0"
                  :class="{'loading-opacity': preloader}"
                  ref="form" :data-url='selectedUrl ? `address/${inputs.id}` : `address`'>
                <div class="form-group row align-items-center">
                    <label for="inputs_name" class="col-sm-3 mb-0">
                        {{ $t('name') }}
                    </label>
                    <app-input id="inputs_name"
                               class="col-sm-9"
                               type="text"
                               v-model="inputs.name"
                               :placeholder="$t('text_type_input')"
                               :required="true"/>
                </div>
                <div class="form-group row align-items-center">
                    <label for="inputs_city" class="col-sm-3 mb-0">
                        {{ $t('city') }}
                    </label>
                    <app-input id="inputs_city"
                               class="col-sm-9"
                               type="text"
                               v-model="inputs.city"
                               :placeholder="$t('text_type_input')"
                               :required="true"/>
                </div>
                <div class="form-group row align-items-center">
                    <label for="inputs_state" class="col-sm-3 mb-0">
                        {{ $t('state') }}
                    </label>
                    <app-input id="inputs_state"
                               class="col-sm-9"
                               type="text"
                               v-model="inputs.state"
                               :placeholder="$t('text_type_input')"
                               :required="true"/>
                </div>
                <div class="form-group row align-items-center">
                    <label for="inputs_zip_code" class="col-sm-3 mb-0">
                        {{ $t('zip_code') }}
                    </label>
                    <app-input id="inputs_zip_code"
                               class="col-sm-9"
                               type="text"
                               v-model="inputs.zip_code"
                               :placeholder="$t('text_type_input')"
                               :required="true"/>
                </div>
                <div class="form-group row align-items-center">
                    <label for="inputs_address" class="col-sm-3 mb-0">
                        {{ $t('address') }}
                    </label>
                    <app-input id="inputs_address"
                               class="col-sm-9"
                               type="textarea"
                               v-model="inputs.address"
                               :placeholder="$t('address_type_input')"
                               :required="true"/>
                </div>
                <div class="form-group row align-items-center">
                    <label for="inputs_country" class="col-sm-3 mb-0">
                        {{ $t('country') }}
                    </label>
                    <app-input id="inputs_country"
                               class="col-sm-9"
                               type="select"
                               :required="true"
                               v-model="inputs.country_id"
                               :list="countriesList"/>
                </div>
                <div class="form-group row align-items-center">
                    <label for="inputs_consignee" class="col-sm-3 mb-0">
                        {{ $t('consignee') }}
                    </label>
                    <app-input id="inputs_consignee"
                               class="col-sm-9"
                               type="select"
                               :required="true"
                               v-model="inputs.consignee_id"
                               :list="consigneesList"/>
                </div>
            </form>
        </template>
    </modal>
</template>

<script>
    import {FormMixin} from '../../../../../../core/mixins/form/FormMixin.js';
    import {ModalMixin} from "../../../../../Mixins/ModalMixin";
    import * as actions from "../../../../../Config/ApiUrl";

    export default {
        name: "AddModal",
        mixins: [FormMixin, ModalMixin],
        props: {
            tableId: String
        },
        data() {
            return {
                preloader: false,
                inputs: {},
                countriesList: [],
                consigneesList: [],
                modalId: 'address-modal',
                modalTitle: this.$t('add'),
            }
        },
        created() {
            if (this.selectedUrl) {
                this.modalTitle = this.$t('edit');
                this.preloader = true;
            }
            this.countryOptions();
            this.consigneeOptions();
        },
        methods: {
            submit() {
                this.save(this.inputs);
            },
            afterSuccess(response) {
                this.$toastr.s(response.data.message);
                this.$hub.$emit('reload-' + this.tableId);
            },

            afterSuccessFromGetEditData(response) {
                this.inputs = response.data;
                this.preloader = false;
            },
            countryOptions() {
                this.axiosGet(actions.ADDRESS_COUNTRY).then(response => {
                    this.countriesList = response.data.map(country => {
                        return {
                            id: country.id,
                            value: country.name
                        }
                    })
                });
            },
            consigneeOptions() {
                this.axiosGet(actions.ADDRESS_CONSIGNEE).then(response => {
                    this.consigneesList = response.data.map(consignee => {
                        return {
                            id: consignee.id,
                            value: consignee.name
                        }
                    })
                });
            }
        },
    }
</script>
