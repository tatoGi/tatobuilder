
let uniques = [];

generate = () => {
    let uniq = ''
    do {
        uniq = Date.now().toString(16)
    } while(uniques.indexOf(uniq) !== -1)

    uniques.push(uniq)

    return uniq
}

$.fn.formFields = function() {
    let data = $(this).data()

    console.log(data)
    let { container, types, langs, hasOptions } = data

    let createOpts = (prefix, el = null) => {
        let idd = generate()

        let opts = el ? el : $(`
        <div class="opts" data-prefix="${prefix}">
            <div class="panel panel-warning">
                <div class="panel-body">
                    <div class="wrap"></div>
                    <div class="text-right" style="padding-bottom:15px">
                        <button class="btn btn-warning" type="button">add answers</button>
                    </div>
                </div>
            </div>
        </div>
        `)

        opts.find('.wrap').children().each(function() {
            let item = $(this)
            item.find('.glyphicon-trash').click(e => {
                e.preventDefault()
                item.next('hr').remove()
                item.remove()
            })
        })

        opts.find('button').click((e) => {
            let id = generate()
            e.preventDefault()

            let item = $(`
            <div class="row">
                ${langs.map(item => `
                <div class="col col-xs-6" style="padding-bottom:20px">
                    <input name="${prefix}[options][${id}]" class="form-control" style="margin:0;"/>
                </div>
                `).join('\n')}
                <a class="text-danger option-delete mdi mdi-delete"></a>
            </div>
            `)
        
            item.find('.glyphicon-trash').click(e => {
                e.preventDefault()
                item.next('hr').remove()
                item.remove()
            })

            opts.find('.wrap').append(item)
        })

        return opts;
    }

    $(`#${container} .opts`).each(function() {
        let prefix = $(this).closest('.panel-body').find('select').attr('name').split('[')
        prefix.pop()
        prefix = prefix.join('[')
        createOpts(prefix, $(this))
    })

    let optionsFunction = function() {
        let $this = $(this)
        let prefix = $(this).attr('name').split('[')
        prefix.pop()
        prefix = prefix.join('[')


        if(hasOptions.indexOf(parseInt($this.val())) !== -1) {
            if(!$this.closest('.panel-body').find('.opts').length && !$this.data('options')) {
                $this.closest('.panel-body').append(createOpts(prefix))
            } else if($this.data('options')) {
                $this.closest('.panel-body').append(createOpts(prefix, $this.data('options')))
            }

        } else  if($this.closest('.panel-body').find('.opts').length){
            $this.data('options', $this.closest('.panel-body').find('.opts').clone())
            $this.closest('.panel-body').find('.opts').remove()
        }
    }


    $(`#${container}`).children().each(function() {
        let html = $(this)

        html.find('.name-field').keyup(function() {
            let el = html.find(`span[data-lang-show="${$(this).closest('[data-lang-show]').data('lang-show')}"]`);
            let value = $(this).val() ? $(this).val() : '---'
            el.text(`${value} (${el.text().split('(').pop()}`)
        })

        // html.find('[data-lang-show]').not(`[data-lang-show="${$(`li.active [data-toggle=tab]`).attr('href')}"]`).hide()

        html.find('.glyphicon-remove').click((e) => {
            e.preventDefault()
            if(confirm('Are you sure?')) {
                html.remove()
            }
        })

        html.find('[name*=type_id]').change(optionsFunction).change()
    })

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href")
        // $('[data-lang-show]').fadeOut('fast', () => {
        //     $('[data-lang-show]').not(`[data-lang-show="${target}"]`).hide()
        //     $(`[data-lang-show="${target}"]`).fadeIn('fast');
        // })
        // $('[data-lang-show]').hide()
        $(`[data-lang-show="${target}"]`).show()
    });

    $(this).click(function() {
        let uid = generate()
        let html = $(`
        <div class="panel panel-default">
            <input type="hidden" name="n_fields[${uid}][sort]" class="sortField" value="${($(`#${container}`).children().length + 1)}"/>
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="${uid}">${langs.map((item) => `
                    <span>--- </span>
                    `).join('\n')}</a>
                    <a href="#" class="text-danger glyphicon glyphicon-remove pull-right mdi mdi-delete"></a>
                </h4>
            </div>
            <div id="${uid}" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="row form-group">
                        <div class="col col-sm-6">
                            ${langs.map((item) => `
                            <div data-lang-show="#lang-${item.id}">
                                <label>field name</label>
                                <input type="text" name="n_fields[${uid}][name]" class="form-control name-field" />
                            </div>
                            `).join('\n')}
                        </div>
                        <div class="col col-sm-6">
                            <label>field type</label>
                            <select class="form-control" name="n_fields[${uid}][type_id]">
                                ${types.map((item) => `<option value="${item.id}">${item.v}</option>`).join('\n')}
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="middle" style="padding-right:20px">
                            <div class="switch small-switch">
                                <input type="hidden" name="n_fields[${uid}][validation][required]" value="0">
                                <input type="checkbox" name="n_fields[${uid}][validation][required]" value="1">
                                <label>validation</label>
                            </div>
                        </label>
                   
                        <label class="middle" style="padding-right:20px">
                            <div class="switch small-switch">
                                <input type="hidden" name="n_fields[${uid}][validation][small_screen]" value="0">
                                <input type="checkbox" name="n_fields[${uid}][validation][small_screen]" value="1">
                                <label>small screen</label>
                            </div>
                        </label>
                      
                    </div>
                </div>
            </div>
        </div>
        `)


        // html.find('[data-lang-show]').not(`[data-lang-show="${$(`li.active [data-toggle=tab]`).attr('href')}"]`).hide()

        html.find('.glyphicon-remove').click((e) => {
            e.preventDefault()
            if(confirm('Are you sure?')) {
                html.remove()
            }
        })

        html.find('[name*=type_id]').change(optionsFunction)


        $(`#${container}`).append(html)

    })
}
$(document).on( 'click', '.panel-title', function () {

    let toggleId = $(this).find('a').data('toggle');
    $("#"+toggleId).toggleClass('collapse');
});

$(document).on( 'click', '.option-delete', function (e) {
    e.preventDefault()
    if(confirm('Are you sure?')) {
    $(this).parent('div.row').remove();
    }
});


