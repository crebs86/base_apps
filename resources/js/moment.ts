import moment from "moment";

const data = (d: string, n = "YYYY-MM-DD", f = 'DD/MM/YYYY') => {
    return d ? moment(d, n).format(f) : '';
}

export default data;