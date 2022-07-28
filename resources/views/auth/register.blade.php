@extends('layouts.app', ['class' => 'bg-gris-oxford'])

@section('content')
@include('layouts.headers.guest')

<div class="container mt--5 pb-5">
    <!-- Table -->
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-transparent pb-2">
                    <h1 style="text-align: center">Registrate</h1>
                </div>
                <div class="card-body px-lg-5 py-lg-3">

                    <form role="form" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                </div>
                                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre') }}" type="text" name="name" value="{{ old('name') }}" required autofocus>
                            </div>
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                </div>
                                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" required>
                            </div>
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" type="password" name="password" required>
                            </div>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control" placeholder="{{ __('Confirmación de Password') }}" type="password" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="row my-4">
                            <div class="col-12">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input class="custom-control-input" id="customCheckRegister" type="checkbox">
                                    <label class="custom-control-label" for="customCheckRegister">
                                        <span class="text-muted">{{ __('Acepto las') }} <a data-toggle="modal" data-target="#exampleModal">{{ __('Politicas de Privacidad') }}</a></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-dark text-cyan mt-4">{{ __('Crear cuenta') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Privacy Policy</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                El presente documento constituye el Aviso de Privacidad para efectos de lo dispuesto en la Ley Federal de Protección de Datos Personales en Posesión de los Particulares y las disposiciones que emanan de ella o se relacionan con la misma. Este Aviso de Privacidad (en lo sucesivo referido como “Aviso”) aplica a la información personal recopilada sobre el Titular por IMPROVEMENT4 TEC S. A. de C. V., en su carácter de Responsable.

                En IMPROVEMENT4 TEC S. A. de C. V., con domicilio en Carretera Federal México - Pachuca, KM 37.5, Colonia Sierra Hermosa, Tecámac, Estado de México, estamos conscientes que usted tiene derecho a conocer qué información recabamos de usted y nuestras prácticas en relación con dicha información. Las condiciones contenidas en el presente son aplicables a toda la información que se recaba a nombre de y por IMPROVEMENT4 TEC S. A. de C. V., (en adelante “EL RESPONSABLE”).

                El presente Aviso tiene por objeto establecer los términos y condiciones en virtud de las cuales “EL RESPONSABLE”:
                A. Recibirá y protegerá los Datos Personales del Titular, a efecto de proteger su privacidad y su derecho a la autodeterminación informativa;

                B. Utilizará los Datos Personales del Titular;

                C. Realizará en su caso las transferencias de Datos Personales a terceros.


                Datos Personales que se recaban
                “EL RESPONSABLE” puede tratar Datos Personales, es decir, información que lo identifica o lo hace identificable. Algunos de estos datos personales son, por ejemplo: nombre, correo electrónico, domicilio postal, domicilio de entrega (en caso de pedidos), número de identificación de documento, fecha de nacimiento, datos de pago (tales como, número de tarjeta de crédito, vigencia), datos de facturación, fecha de nacimiento; número de teléfono fijo y/o celular; Registro Federal de Contribuyentes (RFC); número de tarjetas y/o cuentas, entre otros.
                Estos datos personales usted los proporciona voluntariamente al decidir acceder y/o usar las plataformas tecnológicas de las cuales “EL RESPONSABLE” sea titular como también obtener soporte técnico, registrarse para cierta actividad, ordenar productos o servicios y al registrarse para participar en otras actividades que “EL RESPONSABLE” ofrezca.
                “EL RESPONSABLE” podrá interrelacionar la información que usted proporciona a “EL RESPONSABLE” con otra información que usted haya voluntariamente proporcionado a terceros. Lo anterior, a fin de adaptar nuestros productos o servicios y nuestras promociones a sus preferencias. La recolección de datos personales podrá efectuarse por ejemplo:

                o Mediante el acceso o uso de las plataformas tecnologicas de las cual “EL RESPONSABLE” sea titular.

                o Mediante el uso de correos electrónicos y visitas a nuestras oficinas. Cuando se comunica vía telefónica con nosotros.

                o Mediante la utilización de los sitios Web de “EL RESPONSABLE”.
                o Mediante el uso de herramientas de captura automática de datos a través de la plataformas tecnológicas de las cual “EL RESPONSABLE” sea titular.
                Para el caso de postulantes a empleados podría también solicitarse, entre otros, el acta de nacimiento; comprobantes de estudios; el estado de cuenta de la Administradora de Fondos para el retiro (Afore); la hoja de retención de impuestos, así como de los estudio psicométrico, médico y socio-económico efectuados por “EL RESPONSABLE”. También le podrían ser solicitados los Datos Personales de sus familiares, dependientes o beneficiarios y la documentación comprobatoria conducente.
                Usos y finalidades de sus datos personales
                Los Datos Personales que proporcione a “EL RESPONSABLE” serán tratados, además de para cumplir con las obligaciones derivadas de la relación que con usted pudiera crearse, con las siguientes finalidades:
                a) Proporcionarle información sobre productos, servicios u otras actividades o propuestas de interés de “EL RESPONSABLE” y sus empresas subsidiarias, afiliadas, en su caso.
                b) Utilizamos la información que recopilamos para brindarle los productos y servicios que solicita, para informarle acerca de otros productos y servicios ofrecidos por “EL RESPONSABLE” y para administrar nuestros sitios, servicios, productos o las plataformas tecnológicas de las cual “EL RESPONSABLE” sea titular.
                c) También para realizar estudios sobre datos demográficos, intereses y comportamiento; estudios de mercado y de consumo a efecto de adquirir y ofrecer productos y servicios personalizados, así como publicidad y contenidos más adecuados a sus necesidades.

                d) Para formalizar el proceso transaccional con sus clientes, consumidores, proveedores y otros terceros así como gestionar el proceso de requisición, evaluación y adjudicación de proveedores y otros terceros con los que tratamos.
                e) Para solicitarle que responda algunas encuestas de satisfacción respecto a nuestros productos y servicios.
                f) Para contactarlo en relación con el resultado de las evaluaciones que haya realizado respecto de los productos y servicios de “EL RESPONSABLE” o algún otro tema.
                g) Para dar seguimiento a algún problema que haya surgido respecto a pedidos y/o entrega de producto o servicio.
                h) En general, para hacerle llegar información de “EL RESPONSABLE” y sus empresas subsidiarias, afiliadas y su casa matriz, con fines publicitarios y de promoción.
                En caso que sus datos personales pretendan ser utilizados para una finalidad distinta a las anteriores, “EL RESPONSABLE” le notificará por correo electrónico o por teléfono, a fin de obtener su consentimiento para el tratamiento de sus datos personales de acuerdo a las nuevas finalidades. De no recibir su consentimiento, para los casos en que es necesario, “EL RESPONSABLE” no utilizará sus datos personales.

                Protección a menores: En caso de que “EL RESPONSABLE” considere que los Datos Personales han sido proporcionados por un menor en contravención al presente Aviso, “EL RESPONSABLE” procederá a eliminar tales Datos Personales a la brevedad. Si usted se da cuenta que tales Datos Personales han sido proporcionados por un menor de 18 (dieciocho) años, por favor envíe un correo electrónico a la dirección: datos4tec@gmail.com.

                Transmisión y transferencia de Datos Personales
                “EL RESPONSABLE” no compartirá, sin su consentimiento previo, sus datos personales con terceros, nacionales o extranjeros, fuera del grupo de compañías y filiales de “EL RESPONSABLE”, salvo que:
                a) La ley o un mandato judicial así lo requieran;
                b) Para proteger los derechos o bienes de “EL RESPONSABLE” o de sus clientes;
                c) Que dicha transferencia esté prevista en la Ley Federal de Protección de Datos Personales en Posesión de los Particulares.

                Habiendo leído, entendido y acordado los términos expuestos en este Aviso, el Titular manifiesta su consentimiento para que “EL RESPONSABLE” o cualquier Encargado realicen transferencias de Datos Personales a terceros nacionales o extranjeros, en el entendido de que el tratamiento que dichos terceros den a los Datos Personales del Titular deberá ajustarse a lo establecido en este Aviso.

                “EL RESPONSABLE” le informa al Titular que con el objeto de poder entregar productos, servicios y soluciones a sus clientes, consumidores, empleados, proveedores y demás usuarios de sus servicios, “EL RESPONSABLE” y/o sus Encargados han celebrado o celebrarán diversos acuerdos comerciales con proveedores de productos y servicios, para que le suministren, entre otros servicios, los de: telecomunicaciones y correo electrónico; administración y gestión de bases de datos; tratamiento automatizado de Datos Personales y su almacenamiento; call center para atención al cliente; autenticación y validación de correos electrónicos; terminales de tarjeta de crédito; facturación electrónica; comercialización; transporte e instalación de productos; administración de nóminas y beneficios de seguridad social; servicios de auditoría y otros de naturaleza análoga.
                La autorización del Titular faculta a “EL RESPONSABLE” y/o a sus Encargados a transmitir Datos Personales del Titular a dichos proveedores, en el entendido de que dichos proveedores están obligados, por virtud del contrato correspondiente, a mantener la confidencialidad de los Datos Personales suministrados por “EL RESPONSABLE” y/o sus Encargados y a observar el presente Aviso.

                Su información personal puede transferirse, almacenarse y procesarse en un país distinto de donde se proporcionó. Sí lo hacemos, transferimos la información de conformidad con las leyes de protección de la información aplicables. Tomamos medidas para proteger la información personal sin importar el país donde se almacena o a donde se transfiere. Tenemos procedimientos y controles oportunos para procurar esta protección.

                El Titular reconoce y acepta que “EL RESPONSABLE” no requiere de autorización ni confirmación de dicho Titular para realizar transferencias de Datos Personales nacionales o internacionales en los casos previstos en el Artículo 37 de la LFPDP o en cualquier otro caso de excepción previsto por la misma o la demás legislación aplicable.

                Seguridad
                “EL RESPONSABLE” ha adoptado las medidas de seguridad, administrativas, técnicas y físicas, necesarias para proteger sus datos personales contra daño, pérdida, alteración, destrucción o el uso, acceso o tratamiento no autorizado. Sin embargo, “EL RESPONSABLE” no puede y por ende no garantiza que no existirá un acceso no autorizado a sus datos personales o que las comunicaciones estén libres de toda interrupción, error o intercepción por terceros no autorizados.

                El acceso a sus datos personales en poder de “EL RESPONSABLE” se limitará a las personas que necesiten tener acceso a dicha información, con el propósito de llevar a cabo las finalidades identificadas.

                En caso que al momento de proporcionar sus Datos Personales a “EL RESPONSABLE” se le asigne un nombre de usuario y contraseña, usted será responsable de que dicha información se mantenga confidencial. Le sugerimos no compartir esta información con nadie. Si comparte su equipo, procure siempre cerrar la sesión antes de salir de un sitio o servicio a fin de evitar que terceros no autorizados puedan acceder a su información.

                Los Datos Personales del Titular recolectados por “EL RESPONSABLE” y/o sus Encargados se encontrarán protegidos por medidas de seguridad administrativas, técnicas y físicas adecuadas contra el daño, pérdida, alteración, destrucción o uso, acceso o tratamiento no autorizados, de conformidad con lo dispuesto en la LFPDP y de la regulación administrativa derivada de la misma.
                Derechos que le corresponden

                Usted como titular de datos personales podrá, solicitar ante “EL RESPONSABLE” el acceso, rectificación, cancelación u oposición (derechos ARCO), respecto de sus datos personales.
                Los Derechos ARCO son los siguientes:
                Acceso.- Que se le informe cuáles de sus datos personales están contenidos en las bases de datos de “EL RESPONSABLE” y para qué se utilizan dichos datos personales, el origen de dichos datos y las comunicaciones que se hayan realizado con los mismos.

                Rectificación.- Que se corrijan o actualicen sus datos personales en caso de que sean inexactos o incompletos. Usted deberá informar a “EL RESPONSABLE” de los cambios que se deban hacer a sus datos personales, cuando dichos cambios solo sean de su conocimiento.

                Cancelación.- Que sus datos personales sean dados de baja total o parcialmente de las bases de datos de “EL RESPONSABLE”. Esta solicitud dará lugar a un periodo de bloqueo tras el cual procederá la supresión de los datos. Existen casos en los que la cancelación no será posible en términos de la Ley Federal de Protección de Datos Personales en Posesión de los Particulares y otras disposiciones legales aplicables.

                Oposición.- Oponerse por causa legítima al tratamiento de sus datos personales por parte de “EL RESPONSABLE” o limitar su uso o divulgación. En los casos que la oposición verse sobre la recepción de ciertos comunicados, en dichos comunicados se incluirá la opción para salir de la lista de envío y dejar de recibirlos.

                Usted tiene, en todo momento, derecho de acceder, rectificar y cancelar sus datos personales, así como de oponerse al tratamiento de los mismos o revocar el consentimiento que para tal fin nos haya proporcionado presentando una solicitud con la información y documentación siguiente:
                a) Nombre del Titular y domicilio u otro medio para comunicarle la respuesta a su solicitud;

                b) Los documentos que acrediten su identidad (copia simple en formato impreso o electrónico de su credencial de elector, pasaporte o FM-3) o, en su caso, la representación legal del Titular.

                c) La descripción clara y precisa de los Datos Personales respecto de los que busca ejercer alguno de los Derechos ARCO.

                d) Cualquier otro elemento o documento que facilite la localización de los Datos Personales del Titular.

                e) En el caso de las solicitudes de rectificación de Datos Personales, el Titular respectivo deberá también indicar las modificaciones a realizarse y aportar la documentación que sustente su petición.

                “EL RESPONSABLE” o sus Encargados le responderán al Titular respectivo en un plazo máximo de veinte días hábiles, contados desde la fecha en que se recibió la solicitud. Los plazos antes referidos podrán ser ampliados sólo en términos de la LFPDP.

                La entrega de los Datos Personales será gratuita, solamente le corresponderá cubrir los gastos justificados de envío o el costo de reproducción en copias u otros formatos. Para efectos de las solicitudes de cancelación de Datos Personales, además de lo dispuesto por el presente Aviso, se estará a lo dispuesto en el Artículo 26 de la LFPDP, incluyendo los casos de excepción de cancelación de Datos Personales ahí señalados.

                Consentimiento
                Para efectos de lo dispuesto en la LFPDP y en particular en su Artículo 17, el Titular manifiesta:
                a) Que el presente Aviso le ha sido dado a conocer por “EL RESPONSABLE”;
                b) Haber leído, entendido y acordado los términos expuestos en este Aviso, por lo que otorga su consentimiento respecto del tratamiento de sus Datos Personales para efectos de la LFPDP y demás legislación aplicable. En caso de que los Datos Personales recopilados incluyan Datos Personales sensibles o financieros, mediante la firma del contrato correspondiente, sea en formato impreso, o utilizando medios electrónicos y sus correspondientes procesos para la formación del consentimiento.
                c) Que otorga su consentimiento para que “EL RESPONSABLE” o sus Encargados realicen transferencias de Datos Personales a terceros nacionales o extranjeros, en el entendido de que el tratamiento que dichos terceros den a sus Datos Personales deberá ajustarse a lo establecido en este Aviso.

                En caso de que el Titular no se oponga a los términos del Aviso se considerará acordado y consentido su contenido, en términos del tercer párrafo del artículo 8 de la LFPDP. El consentimiento del Titular podrá ser revocado en cualquier momento por éste sin que se le atribuyan efectos retroactivos conforme a los procedimientos establecidos más adelante para ello en este Aviso.

                No obstante cualquier disposición de este Aviso, el Titular reconoce que no se requerirá de su consentimiento para el tratamiento de Datos Personales por parte de “EL RESPONSABLE” o de terceros en cualquiera de los casos señalados en el Artículo 10 de la LFPDP.

                Al proporcionar cualquier tipo de información, incluyendo sus datos personales, usted expresamente:
                a) Acepta las condiciones contenidas en el presente Aviso;
                b) Está de acuerdo en que la información proporcionada por usted pueda almacenarse, usarse y, en general, tratarse para los fines que se señalan, incluso para fines comerciales y de promoción;
                c) Otorga a “EL RESPONSABLE” autorización para obtener, compilar, almacenar, compartir, comunicar, transmitir y usar tal información de cualquier manera o forma, de conformidad con las condiciones establecidas en el presente y las leyes aplicables.
                Limitación de uso
                “EL RESPONSABLE” y/o sus Encargados conservarán los Datos Personales del Titular durante el tiempo que sea necesario para procesar sus solicitudes de información, productos y/o servicios, así como para mantener los registros contables, financieros y de auditoria en términos de la LFPDP y de la legislación mercantil, fiscal y administrativa vigente. Además de controlar la divulgación de dichos datos o información de socios comerciales.
                Contacto
                Preguntas, comentarios, ejercicio de derechos al Departamento de Protección de Datos
                Personales de “EL RESPONSABLE”
                Correo electrónico: atencion4utec@gmail.com
                Domicilio: en Carretera Federal México - Pachuca, KM 37.5, Colonia Sierra Hermosa, Tecámac, Estado de México,
                Atención: 5567277750
                Cambios al Aviso de Privacidad
                “EL RESPONSABLE” se reserva el derecho de modificar o enmendar, total o parcialmente, el presente Aviso de Privacidad en cualquier momento. El Aviso de Privacidad modificado se le hará llegar al correo electrónico que nos proporcionó. La falta de oposición al nuevo Aviso de Privacidad dentro de los 5 días hábiles siguientes a su recepción se entenderá como su aceptación a los términos que en él se establecen.

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark text-cyan" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection