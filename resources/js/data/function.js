const truncateText = (text , contentMaxLength) => {
    if(text.length > contentMaxLength){
        return text.substr(0, contentMaxLength) + ' ...';
    }
    return text;
}

export{ truncateText };
