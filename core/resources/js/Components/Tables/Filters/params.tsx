const OPERATOR_SEPARATOR = ':';

export const getUrlParams = () => {
    if (window.location.search == '') return {};

    const paramArray = window.location.search.replace('?', '').split('&');

    const filterData = paramArray.reduce((obj, param) => {

        const filterArray = param.split('=');
        const key = filterArray[0];
        const filter = filterArray[1].replace(/%3A/, OPERATOR_SEPARATOR).split(OPERATOR_SEPARATOR);

        let operator;
        let value;

        if (filter.length == 1) {
            operator = 'eq';
            value = filter[0];
        } else {
            operator = filter[0];
            value = filter[2];
        }

        if (!value) {
            return obj;
        }

        return { ...obj, [key]: createFilterParamValue(operator, value) }
    }, {})

    return filterData;
}

export function createFilterParamValue(operation: string, value: string) {
    if (operation == '' || operation == 'search') {
        return value;
    }

    return `${operation}${OPERATOR_SEPARATOR}${value}`;
}
