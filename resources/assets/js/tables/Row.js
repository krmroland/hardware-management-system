import moment from 'moment';

import get from 'lodash/get';

export default class Row {
    constructor(data, columns) {
        this.data = data;
        this.columns = columns;
    }

    getValue(columnName) {
        return get(this.data, columnName);
    }

    getColumn(columnName) {
        return this.columns.find(column => column.dataKey === columnName);
    }

    getFilterableValue(columnName) {
        const value = this.getValue(columnName);

        if (! value) {
            return '';
        }

        return value.toString().toLowerCase();
    }

    passesFilter(filter) 
    {
        let ans=this.columns
            .filter(column =>column.isFilterable())
            .map(column => this.getFilterableValue(column.dataKey))
            .filter(filterableValue => filterableValue.includes(filter.toLowerCase()))
            .length;
            return ans;
        }
    }
