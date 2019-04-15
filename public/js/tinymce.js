tinymce.init({
        selector: '#myform',
        width: '100%',
        language: "fr_FR",
        height: 300,
        plugins: "lists, textcolor, image, link, code, fullscreen, wordcount, autolink, autosave, table, hr",
        toolbar: "undo, redo | formatselect | bold, italic, underline, forecolor, blockquote | link, image | alignleft, aligncenter, alignright | bullist, numlist | fullscreen",
        autosave_restore_when_empty: true,
        menu: {
            edit: {title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall'},
            insert: {title: 'Insert', items: 'link | hr'},
            format: {title: 'Format', items: 'bold italic underline strikethrough | removeformat | code'},
            table: {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'},
            tools: {title: 'Tools', items: 'restoredraft'}
        },
        mobile: {
            theme: 'mobile',
            plugins: ['lists'],
            toolbar: ['undo', 'redo', 'bold', 'italic', 'link', 'bullist', 'numlist']
        },
        content_style: "* {font-family: 'Open Sans', sans-serif} p {font-size: 1em} a {color: #007bff} p, h1, h2, h3, h4, h5, h6 {color: #2b343d}",
        content_css: ['//fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i']
    });
