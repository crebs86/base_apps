function inArray(has, needle) {
    if (typeof needle !== 'object' || typeof has !== 'object') {
        throw new Error('Função deve receber dois arrays|objetos.')
    }
    for (var ii = 0; ii < needle.length; ii++) {
        for (var i = 0; i < has.length; i++) {
            if (has[i] === needle[ii]) return true;
        }
    }
    return false;
}

export default function has(has, needle) {
    if (inArray(has, needle)) {
        return true
    }
    return false;
}