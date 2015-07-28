<div class="reservation-list large-11 columns large-centered" ng-controller="reservationListController">
  <table width="100%">
    <thead>
      <tr>
        <th>Name</th>
        <th>Unit</th>
        <th>Development</th>
        <th>Reservation Date</th>
        <th>Reserved By</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>

      <tr ng-repeat="list in reservationList.response">
        <td><a href="/single-reservation?id={{list.node.serialNumber}}">{{list.node.firstName}} {{list.node.lastName}}</a></td>
        <td>{{list.node.unit}}</td>
        <td>{{list.node.project}}</td>
        <td>{{list.node.reservedDate}}</td>
        <td>{{list.node.reservedBy}}</td>
        <td class="pending" data-reveal-id="myModal" class="myModal" ng-click="setSid(list.node.serialNumber, list.node.unit, list.node.firstName, list.node.reservedBy, list.node.project)"><a href="#">{{list.node.status}}</a></td>
      </tr>

    </tbody>
  </table>

  <div id="myModal" class="reveal-modal tiny" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
    <div class="large-12 columns units approval large-centered">
      <div class="large-12 columns bldg">
        <center> SELECT ACTION </center>
      </div>
      <select class="large-6 columns" ng-model="status">
        <option value="approved">APPROVED</option>
        <option value="declined">DECLINED</option>
        <option value="denied">DENIED</option>
        <option value="sold">SOLD</option>
      </select>
      <button class="large-6 columns right close-approval" ng-click="closeModal()"> DONE </button>
      <div class="clear-both"></div>
    </div>
    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
  </div>

</div>