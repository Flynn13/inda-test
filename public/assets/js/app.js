const App = {
    eventHandler : function() {
        $('body').on('change', '#search', function() {
            id = $(this).val();
            if(id.length) {
                App.searchById(id);
            } else {
                $('#no-result').slideUp();
                $('#search-result').slideUp();
            }

        });

        $('body').on('click', '#add', function() {
            App.addJournalist()
        });

        $('body').on('change', '#filter', function() {
            App.filter($(this).val());
        });

        $('body').on('click', '#update', function() {
            App.updateJournalist($(this).data('id'))
        });
    },
    searchById: function(id) {
        let data = {
            id: id
        }

        $.ajax({
            url     : 'search',
            data    : data,
            type    : 'post',
            dataType: 'json',
        }).done(function(re) {
            let searchResult = $('#search-result');
            $('#no-result').addClass('hide');
            if(JSON.stringify(re).length > 2) {
                let tbody = $('.result-tbody');
                tbody.html('');
                tbody.append(
                    '<tr>' +
                    '<td>' + re.id + '</td>' +
                    '<td>' + re.name + '</td>' +
                    '<td>' + re.alias + '</td>'  +
                    '<td>' + re.group_name + '</td>'  +
                    '</tr>'
                );
                searchResult.slideDown();
            } else {
                searchResult.slideUp();
                $('#no-result').removeClass('hide');
            }
        });
    },

    addJournalist: function() {
        let data = {
            name: $('#name').val(),
            alias: $('#alias').val(),
            group_id: $('#group-id').val()
        }

        $.ajax({
            url     : 'journalist/add',
            data    : data,
            type    : 'post',
            dataType: 'json',
        }).done(function(re) {
            location.reload()
        });
    },

    updateJournalist: function(id) {
        let data = {
            id: id,
            name: $('#name-update').val(),
            alias: $('#alias-update').val(),
            group_id: $('#group-id-update').val()
        }
        $.ajax({
            url     : '/journalist/update',
            data    : data,
            type    : 'post',
            dataType: 'json',
        }).done(function(re) {
            location.href = '/';
        });
    },

    filter: function(id) {
        $.ajax({
            url     : 'journalist/filter',
            data    : { id: id},
            type    : 'post',
            dataType: 'json',
        }).done(function(re) {
            let tbody = $('.journalists tbody')
            tbody.html('');
            for(let i = 0; i < re.length; i++) {
                tbody.append(
                    '<tr>' +
                    '<td>' + re[i].id + '</td>' +
                    '<td>' + re[i].name + '</td>' +
                    '<td>' + re[i].alias + '</td>'  +
                    '<td>' + re[i].group_name + '</td>'  +
                    '<td><a href="/journalist/'+re[i].id+'/edit"><i class="fa fa-edit"></i></a></td>' +
                    '</tr>'
                );
            }
        });
    }

}

$(function() {
    App.eventHandler();
})