function inArray(needle, array) {
    for (var ii = 0; ii < needle.length; ii++) {
        for (var i = 0; i < array.length; i++) {
            if (array[i] == needle[ii]) return true;
        }
    }
    return false;
}

export default function hasPermission(userPermissions, needle) {
    if (inArray(needle, userPermissions)) {
        return true
    }
    return false;
}
