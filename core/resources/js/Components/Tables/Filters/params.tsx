const OPERATOR_SEPARATOR = ':';

export const getUrlParams = () => {
    if (window.location.search == '') return {};

    const paramArray = window.location.search.replace('?', '').split('&');

    const filterData = paramArray.reduce((obj, param) => {
        const filterArray = param.split('=');
        const key = filterArray[0];
        const value = filterArray[1];

        return { ...obj, [key]: value }
    }, {})

    return filterData;
}

export function createFilterParamValue(operation: string, value: string) {
    return `${operation}${OPERATOR_SEPARATOR}${value}`
}
