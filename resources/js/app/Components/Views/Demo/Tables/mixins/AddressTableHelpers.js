export const TableHelpers = {
    data() {
        return {
            tableColumns : [
                {
                    title: this.$t('name'),
                    type: 'text',
                    key: 'name',
            
                },
                {
                    title: this.$t('address'),
                    type: 'text',
                    key: 'address',
            
                },
                {
                    title: this.$t('city'),
                    type: 'text',
                    key: 'city',
                },
                {
                    title: this.$t('state'),
                    type: 'text',
                    key: 'state',
                },
                {
                    title: this.$t('zip_code'),
                    type: 'text',
                    key: 'zip_code',
                },
                {
                    title: this.$t('country'),
                    type: 'object',
                    key: 'country',
                    modifier: (value, row) => {
                        return row.country.name
                    }
                },
            ],
            actionObj : {
                title: this.$t('action'),
                type: 'action',
            }
        }
    },
}