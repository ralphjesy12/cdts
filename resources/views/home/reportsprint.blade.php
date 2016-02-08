<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Mcdonald&#39;s Crew Development Training System</title>

    <style>
    html {
      font-family: sans-serif;
      -webkit-text-size-adjust: 100%;
          -ms-text-size-adjust: 100%;
    }
    body {
      margin: 0;
    }
    article,
    aside,
    details,
    figcaption,
    figure,
    footer,
    header,
    hgroup,
    main,
    menu,
    nav,
    section,
    summary {
      display: block;
    }
    audio,
    canvas,
    progress,
    video {
      display: inline-block;
      vertical-align: baseline;
    }
    audio:not([controls]) {
      display: none;
      height: 0;
    }
    [hidden],
    template {
      display: none;
    }
    a {
      background-color: transparent;
    }
    a:active,
    a:hover {
      outline: 0;
    }
    abbr[title] {
      border-bottom: 1px dotted;
    }
    b,
    strong {
      font-weight: bold;
    }
    dfn {
      font-style: italic;
    }
    h1 {
      margin: .67em 0;
      font-size: 2em;
    }
    mark {
      color: #000;
      background: #ff0;
    }
    small {
      font-size: 80%;
    }
    sub,
    sup {
      position: relative;
      font-size: 75%;
      line-height: 0;
      vertical-align: baseline;
    }
    sup {
      top: -.5em;
    }
    sub {
      bottom: -.25em;
    }
    img {
      border: 0;
    }
    svg:not(:root) {
      overflow: hidden;
    }
    figure {
      margin: 1em 40px;
    }
    hr {
      height: 0;
      -webkit-box-sizing: content-box;
         -moz-box-sizing: content-box;
              box-sizing: content-box;
    }
    pre {
      overflow: auto;
    }
    code,
    kbd,
    pre,
    samp {
      font-family: monospace, monospace;
      font-size: 1em;
    }
    button,
    input,
    optgroup,
    select,
    textarea {
      margin: 0;
      font: inherit;
      color: inherit;
    }
    button {
      overflow: visible;
    }
    button,
    select {
      text-transform: none;
    }
    button,
    html input[type="button"],
    input[type="reset"],
    input[type="submit"] {
      -webkit-appearance: button;
      cursor: pointer;
    }
    button[disabled],
    html input[disabled] {
      cursor: default;
    }
    button::-moz-focus-inner,
    input::-moz-focus-inner {
      padding: 0;
      border: 0;
    }
    input {
      line-height: normal;
    }
    input[type="checkbox"],
    input[type="radio"] {
      -webkit-box-sizing: border-box;
         -moz-box-sizing: border-box;
              box-sizing: border-box;
      padding: 0;
    }
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      height: auto;
    }
    input[type="search"] {
      -webkit-box-sizing: content-box;
         -moz-box-sizing: content-box;
              box-sizing: content-box;
      -webkit-appearance: textfield;
    }
    input[type="search"]::-webkit-search-cancel-button,
    input[type="search"]::-webkit-search-decoration {
      -webkit-appearance: none;
    }
    fieldset {
      padding: .35em .625em .75em;
      margin: 0 2px;
      border: 1px solid #c0c0c0;
    }
    legend {
      padding: 0;
      border: 0;
    }
    textarea {
      overflow: auto;
    }
    optgroup {
      font-weight: bold;
    }
    table {
      border-spacing: 0;
      border-collapse: collapse;
    }
    td,
    th {
      padding: 0;
    }
    /*! Source: https://github.com/h5bp/html5-boilerplate/blob/master/src/css/main.css */
    @media print {
      *,
      *:before,
      *:after {
        color: #000 !important;
        text-shadow: none !important;
        background: transparent !important;
        -webkit-box-shadow: none !important;
                box-shadow: none !important;
      }
      a,
      a:visited {
        text-decoration: underline;
      }
      a[href]:after {
        content: " (" attr(href) ")";
      }
      abbr[title]:after {
        content: " (" attr(title) ")";
      }
      a[href^="#"]:after,
      a[href^="javascript:"]:after {
        content: "";
      }
      pre,
      blockquote {
        border: 1px solid #999;

        page-break-inside: avoid;
      }
      thead {
        display: table-header-group;
      }
      tr,
      img {
        page-break-inside: avoid;
      }
      img {
        max-width: 100% !important;
      }
      p,
      h2,
      h3 {
        orphans: 3;
        widows: 3;
      }
      h2,
      h3 {
        page-break-after: avoid;
      }
      .navbar {
        display: none;
      }
      .btn > .caret,
      .dropup > .btn > .caret {
        border-top-color: #000 !important;
      }
      .label {
        border: 1px solid #000;
      }
      .table {
        border-collapse: collapse !important;
      }
      .table td,
      .table th {
        background-color: #fff !important;
      }
      .table-bordered th,
      .table-bordered td {
        border: 1px solid #ddd !important;
      }
    }

    .table {
  width: 100%;
  max-width: 100%;
  margin-bottom: 20px;
}
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
  padding: 8px;
  line-height: 1.42857143;
  vertical-align: top;
  border-top: 1px solid #ddd;
}
.table > thead > tr > th {
  vertical-align: bottom;
  border-bottom: 2px solid #ddd;
}
.table > caption + thead > tr:first-child > th,
.table > colgroup + thead > tr:first-child > th,
.table > thead:first-child > tr:first-child > th,
.table > caption + thead > tr:first-child > td,
.table > colgroup + thead > tr:first-child > td,
.table > thead:first-child > tr:first-child > td {
  border-top: 0;
}
.table > tbody + tbody {
  border-top: 2px solid #ddd;
}
.table .table {
  background-color: #fff;
}
.table-condensed > thead > tr > th,
.table-condensed > tbody > tr > th,
.table-condensed > tfoot > tr > th,
.table-condensed > thead > tr > td,
.table-condensed > tbody > tr > td,
.table-condensed > tfoot > tr > td {
  padding: 5px;
}
.table-bordered {
  border: 1px solid #ddd;
}
.table-bordered > thead > tr > th,
.table-bordered > tbody > tr > th,
.table-bordered > tfoot > tr > th,
.table-bordered > thead > tr > td,
.table-bordered > tbody > tr > td,
.table-bordered > tfoot > tr > td {
  border: 1px solid #ddd;
}
.table-bordered > thead > tr > th,
.table-bordered > thead > tr > td {
  border-bottom-width: 2px;
}
.table-striped > tbody > tr:nth-of-type(odd) {
  background-color: #f9f9f9;
}
.table-hover > tbody > tr:hover {
  background-color: #f5f5f5;
}
table col[class*="col-"] {
  position: static;
  display: table-column;
  float: none;
}
table td[class*="col-"],
table th[class*="col-"] {
  position: static;
  display: table-cell;
  float: none;
}
.table > thead > tr > td.active,
.table > tbody > tr > td.active,
.table > tfoot > tr > td.active,
.table > thead > tr > th.active,
.table > tbody > tr > th.active,
.table > tfoot > tr > th.active,
.table > thead > tr.active > td,
.table > tbody > tr.active > td,
.table > tfoot > tr.active > td,
.table > thead > tr.active > th,
.table > tbody > tr.active > th,
.table > tfoot > tr.active > th {
  background-color: #f5f5f5;
}
.table > thead > tr > td.success,
.table > tbody > tr > td.success,
.table > tfoot > tr > td.success,
.table > thead > tr > th.success,
.table > tbody > tr > th.success,
.table > tfoot > tr > th.success,
.table > thead > tr.success > td,
.table > tbody > tr.success > td,
.table > tfoot > tr.success > td,
.table > thead > tr.success > th,
.table > tbody > tr.success > th,
.table > tfoot > tr.success > th {
  background-color: #dff0d8;
}
.table > thead > tr > td.info,
.table > tbody > tr > td.info,
.table > tfoot > tr > td.info,
.table > thead > tr > th.info,
.table > tbody > tr > th.info,
.table > tfoot > tr > th.info,
.table > thead > tr.info > td,
.table > tbody > tr.info > td,
.table > tfoot > tr.info > td,
.table > thead > tr.info > th,
.table > tbody > tr.info > th,
.table > tfoot > tr.info > th {
  background-color: #d9edf7;
}
.table > thead > tr > td.warning,
.table > tbody > tr > td.warning,
.table > tfoot > tr > td.warning,
.table > thead > tr > th.warning,
.table > tbody > tr > th.warning,
.table > tfoot > tr > th.warning,
.table > thead > tr.warning > td,
.table > tbody > tr.warning > td,
.table > tfoot > tr.warning > td,
.table > thead > tr.warning > th,
.table > tbody > tr.warning > th,
.table > tfoot > tr.warning > th {
  background-color: #fcf8e3;
}
.table > thead > tr > td.danger,
.table > tbody > tr > td.danger,
.table > tfoot > tr > td.danger,
.table > thead > tr > th.danger,
.table > tbody > tr > th.danger,
.table > tfoot > tr > th.danger,
.table > thead > tr.danger > td,
.table > tbody > tr.danger > td,
.table > tfoot > tr.danger > td,
.table > thead > tr.danger > th,
.table > tbody > tr.danger > th,
.table > tfoot > tr.danger > th {
  background-color: #f2dede;
}
tbody:before, tbody:after { display: none; }
    </style>
</head>
<body>
    @if(!empty($input['user']))
    <table>
        <tbody>
            <tr>
                <td><b>Name</b></td>
                <td style="width:50px;text-align:center;"> : </td>
                <td>{{ $user->fullname }}</td>
            </tr>
            <tr>
                <td><b>Position</b></td>
                <td style="width:50px;text-align:center;"> : </td>
                <td>{{ $user->position }}</td>
            </tr>
            <tr>
                <td><b>Station</b></td>
                <td style="width:50px;text-align:center;"> : </td>
                <td>{{ $user->station }}</td>
            </tr>
            <tr>
                <td><b>Crew Service Date</b></td>
                <td style="width:50px;text-align:center;"> : </td>
                <td>{{ $user->created_at->toFormattedDateString() }}</td>
            </tr>
        </tbody>
    </table>
    <hr>
    <table class="table table-condensed table-bordered">
        <thead>
            <tr>
                <th>Date Taken</th>
                <th>Exam Title</th>
                <th>Remarks</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
            @if(count($assessment))
            @foreach($assessment as $k => $a)
            <tr>
                <td>{{ $a->created_at->toFormattedDateString() }}</td>
                <td>{{ $a->exam()->first()->title }}</td>
                <td>{{ $a->score > 0.7 ? 'Passed' : 'Failed'}}</td>
                <td>{{ $a->score * 100 }}%</td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="4" class="text-center">
                    No Examinations Found
                </td>
            </tr>
            @endif
        </tbody>
    </table>
    @else
    <table class="table table-condensed table-bordered">
        <thead>
            <tr>
                <th>Date Taken</th>
                <th>Name</th>
                <th>Position</th>
                <th>Exam Title</th>
                <th>Remarks</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
            @if(count($assessment))
            @foreach($assessment as $k => $a)
            <tr>
                <td>{{ $a->created_at->toFormattedDateString() }}</td>
                <td>{{ $a->user()->first()->fullname }}</td>
                <td>{{ $a->user()->first()->position }}</td>
                <td>{{ $a->exam()->first()->title }}</td>
                <td>{{ $a->score > 0.7 ? 'Passed' : 'Failed'}}</td>
                <td>{{ $a->score * 100 }}%</td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="6" class="text-center">
                    No Examinations Found
                </td>
            </tr>
            @endif
        </tbody>
    </table>
    @endif

</body>
</html>
