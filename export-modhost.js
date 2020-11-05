if ($('input[name=id]').val()) {
    $.post(
        'https://s24275.h3.modhost.pro/export-modhost.php',
        {
            id: $('input[name=id]').val(),
            name: $('input[name=name]').val(),
            date: $('#hoster-form-site-info').find('tr').eq(2).find('.text').html(),
            dev: $('a.site').html(),
        },
        function(response) {
            document.location.href = document.location.href.replace('info', 'domains');
        }
    );
} else if($('input[name=site_id]').val()) {
    var domains = [];
    $('td.domain').each(function(){
        domains.push($(this).find('a').html());
    });
    $.post(
        'https://s24275.h3.modhost.pro/export-modhost.php',
        {
            id: $('input[name=site_id]').val(),
            domains: domains
        },
        function(response) {
            window.close();
        }
    );
} else {
    $('td.name').find('a').each(function(){
        window.open($(this).attr('href'));
    });
}