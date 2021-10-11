$('#buscarAuto').bootstrapValidator({
    message: 'Este valor no es valido',
    feedbackIcons: {
        valid: 'fa fa-check',
        invalid: 'fa fa-exclamation',
        validating: 'fa fa-circle'
    },
    fields: {
        patente: {
            message : 'Ingrese la patente',
            validators: {
                notEmpty: {},
                stringLength: {
                    min: 7,
                    max: 7,
                    message: 'El formato de patente ingresado no es válido'
                },
                regexp: {
                    regexp: /^([A-Z]{3} [0-9]{3})$/,
                    message: 'El formato de patente ingresado no es válido'
                },
            }
        }
    }
})
.on('error.validator.bv', function(e, data) {
    data.element
        .data('bv.messages')
        .find('.help-block[data-bv-for="' + data.field + '"]').hide()
        .filter('[data-bv-validator="' + data.validator + '"]').show();
});

$('#datapers').bootstrapValidator({
    message: 'Este valor no es valido',
    feedbackIcons: {
        valid: 'fa fa-check',
        invalid: 'fa fa-exclamation',
        validating: 'fa fa-circle'
    },
    fields: {
        nombre: {
            message : 'Ingrese el nombre',
            validators: {
                notEmpty: {
                    message: 'Este campo no puede estar vacío'
                },
                stringLength: {
                    max: 50,
                    message: 'El nombre es muy largo.'
                },
                regexp: {
                    regexp: /^[A-Za-zñáéíóúÑÁÉÍÓÚüÜ ]+$/,
                    message: 'Se detectan caracteres inválidos'
                }
            }
        },
        apellido: {
            message : 'Ingrese el apellido',
            validators: {
                notEmpty: {
                    message: 'Este campo no puede estar vacío'
                },
                stringLength: {
                    max: 50,
                    message: 'El apellido es muy largo.'
                },
                regexp: {
                    regexp: /^[A-Za-zñáéíóúÑÁÉÍÓÚüÜ ]+$/,
                    message: 'Se detectan caracteres inválidos'
                }
            }
        },
        nroDni: {
            message: 'Ingrese el nro de DNI',
            validators: {
                notEmpty: {
                    message: 'Este campo no puede estar vacío'
                },
                stringLength: {
                    max: 10,
                    message: 'El DNI es muy largo.'
                },
                greaterThan: {
                    value: 1,
                    message: 'El DNI no puede empezar con 0.'
                },
            }
        },
        fechaNac: {
            message: 'Ingrese el nro de DNI',
            validators: {
                notEmpty: {
                    message: 'Este campo no puede estar vacío'
                },
                stringLength: {
                    max: 10,
                    message: 'La fecha es inválida'
                },
                regexp: {
                    regexp: /(\d{4})-(\d{2})-(\d{2})/,
                    message: 'La fecha es inválida'
                }
            }
        },
        telefono: {
            message: 'Ingrese el número de teléfono',
            validators: {
                notEmpty: {
                    message: 'Este campo no puede estar vacío'
                },
                stringLength: {
                    max: 20,
                    message: 'El teléfono es muy largo'
                },
                regexp: {
                    regexp: /^[0-9-]+$/,
                    message: 'Ej. 123-4567890'
                }
            }
        },
        domicilio: {
            message : 'Ingrese el domicilio',
            validators: {
                notEmpty: {
                    message: 'Este campo no puede estar vacío'
                },
                stringLength: {
                    max: 200,
                    message: 'El domicilio es muy largo.'
                },
                regexp: {
                    regexp: /^[0-9A-Za-zñáéíóúÑÁÉÍÓÚüÜ, ]+$/,
                    message: 'Se detectan caracteres inválidos'
                }
            }
        },
    }
})
.on('error.validator.bv', function(e, data) {
    data.element
        .data('bv.messages')
        .find('.help-block[data-bv-for="' + data.field + '"]').hide()
        .filter('[data-bv-validator="' + data.validator + '"]').show();
});

$('#cambioDuenio').bootstrapValidator({
    message: 'Este valor no es valido',
    feedbackIcons: {
        valid: 'fa fa-check',
        invalid: 'fa fa-exclamation',
        validating: 'fa fa-circle'
    },
    fields: {
        patente: {
            message : 'Ingrese la patente',
            validators: {
                notEmpty: {},
                stringLength: {
                    min: 7,
                    max: 7,
                    message: 'El formato de patente ingresado no es válido'
                },
                regexp: {
                    regexp: /^[a-zA-Z0-9 ]+$/,
                    message: 'El formato de patente ingresado no es válido'
                },
            }
        },
        nroDni: {
            message: 'Ingrese el nro de DNI',
            validators: {
                notEmpty: {
                    message: 'Este campo no puede estar vacío'
                },
                stringLength: {
                    max: 10,
                    message: 'El DNI es muy largo.'
                },
                greaterThan: {
                    value: 1,
                    message: 'El DNI no puede empezar con 0.'
                },
            }
        }
    }
})
.on('error.validator.bv', function(e, data) {
    data.element
        .data('bv.messages')
        .find('.help-block[data-bv-for="' + data.field + '"]').hide()
        .filter('[data-bv-validator="' + data.validator + '"]').show();
});