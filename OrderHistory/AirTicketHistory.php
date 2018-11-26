<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
	header('location: ../login.php');
}
 ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link href="../css/font-awesome.css" type="text/css" rel="stylesheet" />
		<link href="../css/style.css" type="text/css" rel="stylesheet" />
		<link href="../css/accounting.css" type="text/css" rel="stylesheet" />
		<link href="../css/historicalOrder.css" type="text/css" rel="stylesheet" />
		<link href="../css/pagination.css" rel="stylesheet" type="text/css" />
		<title>会计-历史订单（机票）</title>
	</head>
	<body>
		<div class="msWidth">
			<!--header s-->
			<div class="header">
				<div class="nm-left">
					<span class="ms-theam">旅行社管理系统</span>
				</div>
				<div class="nm-right user-info">
					<ul>
						<li>
							<a href="javascript:void(0);">
								<span><?php echo $_SESSION['username']; ?>
							</a>
						</li>
						<li class="login">
							<a href="javascript:void(0);">
								退出
							</a>
						</li>
					</ul>
				</div>
			</div>
			<!--header e-->
			<!--content  s-->
			<div class="msContent">
				<!--左侧导航部分     s-->
				<div class="navInfo nm-left">
					<ul>
						<li class="shouye">
							<a href="../index.php" class="bm-title">
								<img src="../img/shouye.png">
								首页
							</a>
						</li>
						<li class="yewu">
							<a href="../GroupTour/GroupTourCreate.php" class="bm-title ">
								<img src="../img/yewu.png">
								业务
							</a>
							<dl class="detailMsg nm-hide">
								<dd>
									<a href="../GroupTour/GroupTourCreate.php">
										<label></label> 独立团
									</a>
								</dd>
								<dd>
									<a href="../IndividualTour/IndividualTourCreate.php">
										<label></label> 散拼团
									</a>
								</dd>
								<dd>
									<a href="../AirTicket/AirTicketCreate.php">
										<label></label> 机票
									</a>
								</dd>
							</dl>
						</li>
						<li class="kuaiji title-active">
							<a href="../Other/AccountingConfirm.php" class="bm-title">
								<img src="../img/c_kuaiji.png">
								财务
							</a>
							<dl class="detailMsg">
								<!--<dd>
									<a href="javascript:void(0);" class="lab-active">
										<label></label> 历史订单
									</a>
								</dd>
								<dd>
									<a href="../AccountingService/GroupTourService.php"><label></label> 会计服务</a>
								</dd>-->
								<dd>
									<a href="../Other/AccountingConfirm.php">
										<label></label>业务管理
									</a>
								</dd>
							</dl>
						</li>
						<li class="guanli">
							<a href="../Manage/TourGuideManage.php" class="bm-title">
								<img src="../img/guanli.png">
								管理
							</a>
							<dl class="detailMsg nm-hide">
								<dd>
									<a href="javascript:void(0);" class="lab-active">
										<label></label> 导游
									</a>
								</dd>
								<dd>
									<a href="javascript:void(0);">
										<label></label> 销售
									</a>
								</dd>
								<dd>
									<a href="javascript:void(0);">
										<label></label> 供应商
									</a>
								</dd>
							</dl>
						</li>
						<li class="bm-title qita">
							<a href="../Other/NoticeManage.php">
								<img src="../img/qita.png">
								其他
							</a>
						</li>
					</ul>

				</div>
				<!--左侧导航部分     e-->
				<!--右侧内容             s-->
				<div class="theamInfo nm-right">
					<div class="showMsg kuaijiMsg">
						<div class="floor accountingInfo">
							<div class="navGroup accountingNav">
								<ul>
									<li class="recordAll">
										<a href="javascript:void(0);">
											全部
										</a>
									</li>
									<li class="groupTour">
										<a href="javascript:void(0);">
											独立团
										</a>
									</li>
									<li class="individualTour">
										<a href="javascript:void(0);">
											散拼团
										</a>
									</li>
									<li class="airTicket accountingNav-active">
										<a href="javascript:void(0);">
											机票
										</a>
									</li>
								</ul>
							</div>
							<!--历史记录  s-->
							<div class="groupMsg historicRecord">
								<!--筛选信息     s-->
								<div class="filterBox">
									<!--基本信息    s-->
									<div class="filterBasicInfo filterInfo">
										<label class="markMsg"><i></i>基本信息</label>
										<ul>
											<li>
												<label>订单号</label>
												<input type="text" id="transaction-id">
											</li>
											<li class="statusOption">
												<label>状态</label>
												<div class="checkbox checkbox-success firstCheck">
													<input id="unClear" class="styled" type="checkbox" checked="checked">
													<label for="unClear">未完成订单</label>
												</div>
												<div class="checkbox checkbox-success">
													<input id="clearOrder" class="styled" type="checkbox">
													<label for="clearOrder">Clear订单</label>
												</div>
												<div class="checkbox checkbox-success">
													<input id="lockOrder" class="styled" type="checkbox">
													<label for="lockOrder">Lock订单</label>
												</div>
											</li>
											<li>
												<label>定位</label>
												<input type="text" id="air-ticket-locator">
											</li>
											<li class="dateOption">
												<label>创建时间</label>
												<select id="time-filter">
													<option value="all">全部</option>
													<option value="customized">Customized</option>
													<option value="today">今天</option>
													<option value="week">最近一周</option>
													<option value="month">最近一个月</option>
													<option value="year">最近一年</option>
												</select>
												<div class="dateRange nm-hide  groupTourDateRange">
													<label style="visibility: hidden;">创建时间</label>
													<input type="date" class="firstItem" id="start-date">
													<span>~</span>
													<input type="date" id="to-date">
												</div>
											</li>
										</ul>
									</div>
									<!--基本信息    e-->
									<!--高级信息    s-->
									<div class="filterAdvancedInfo filterInfo">
										<label class="markMsg"><i></i>高级信息</label>
										<ul>
											<li>
												<label>付款方式</label>
												<select id="payment-type">
													<option value="all">全部</option>
													<option value="creditcard">Credit Card</option>
													<option value="mco">MCO</option>
													<option value="alipay">Alipay</option>
													<option value="wechat">WeChat</option>
													<option value="cash">Cash</option>
													<option value="check">Check</option>
													<option value="other">Other</option>
													<option value="remit">REMIT</option>
												</select>
											</li>
											<li class="infoDistrict">
												<label>利润</label>
												<div class="currencyInfo">
													<a href="javascript:void(0);" class="currencySelected">$</a>
													<input type="text" id="profit-min">
													<span>~</span>
													<input type="text" id="profit-max">
												</div>
											</li>
											<li>
												<label>销售</label>
												<input id="salesperson" type="text" placeholder="Search..." <?php if ($_SESSION["group_name"] == 'normal') { echo "value='" . $_SESSION['username'] . "' disabled"; } ?>>
											</li>
											<li class="infoDistrict">
												<label>成本</label>
												<div class="currencyInfo">
													<a href="javascript:void(0);" class="currencySelected">$</a>
													<input type="text" id="cost-min">
													<span>~</span>
													<input type="text" id="cost-max">
												</div>
											</li>
											<li>
												<label>旅行社来源</label>
                                                <input id="travel-agency" type="text" placeholder="Search...">
											</li>
											<li class="infoDistrict">
												<label>收入</label>
												<div class="currencyInfo">
													<a href="javascript:void(0);" class="currencySelected">$</a>
													<input type="text" id="price-min">
													<span>~</span>
													<input type="text" id="price-max">
												</div>
											</li>
											<li>
												<label>来源</label>
                                                <input id="source" type="text" placeholder="Search...">
											</li>
										</ul>
									</div>
								</div>
								<!--机票信息  s-->
								<div class="filterGroupTourInfo filterInfo">
									<label class="markMsg"><i></i>机票信息</label>
									<ul>
										<li class="passengerNum">
											<label>乘客人数</label>
											<div>
												<input type="text"  placeholder="成人" id="adult-number">
												<input type="text"  placeholder="小孩" id="children-number">
												<input type="text" 	placeholder="婴儿"  class="lastItem" id="infant-number">
											</div>
										</li>
										<!-- <li class="spectator">
											<label>购票人姓名</label>
											<input type="text" id="customer-name">
										</li> -->
										<li>
											<label>航班号</label>
											<input type="text" id="flight-number">
										</li>
										<li class="statusOption checkboxItem">
											<label>往返</label>
											<!--
												<div class="checkbox checkbox-success">
													<input id="checkbox9" class="styled" type="checkbox" checked="checked">
													<label for="checkbox9">只查看未过期折扣码</label>
					             				</div>
												-->
											<div class="checkbox checkbox-success firstCheck">
												<input id="arriveAndDepart" class="styled" type="checkbox">
												<label for="arriveAndDepart">往返</label>
					             			</div>
					             			<div class="checkbox checkbox-success firstCheck">
												<input id="singleTrip" class="styled" type="checkbox">
												<label for="singleTrip">单程</label>
					             			</div>
										</li>
										<li class="infoDistrict">
											<label>行程地点</label>
											<input type="text" id="leave-airport">
											<span>~</span>
											<input type="text" id="arrival-airport">
										</li>
										<li class="statusOption checkboxItem">
											<label>团散</label>
											<div class="checkbox checkbox-success firstCheck">
												<input id="groupTicket" class="styled" type="checkbox">
												<label for="groupTicket">团票</label>
					             			</div>
					             			<div class="checkbox checkbox-success firstCheck">
												<input id="indivTicket" class="styled" type="checkbox">
												<label for="indivTicket">散票</label>
					             			</div>
										</li>
										<li class="infoDistrict">
											<label>出发日期</label>
											<input type="date" style="margin-left: 6%;" id="leave-date">
											<span>~</span>
											<input type="date" id="arrival-date">
										</li>
										<li class="choice statusOption checkboxItem">
											<label>退款</label>
    										<div class="checkbox checkbox-success firstCheck">
												<input id="refund" class="styled" type="checkbox">
												<label for="refund">退款</label>
					             			</div>
										</li>
									</ul>
								</div>
								<!--机票信息  e-->
								<!--筛选信息     e-->
								<div class="actionRecord">
									<ul>
										<li><a href="javascript:void(0);" id="filter-confirm">确认</a></li>
										<li><a href="javascript:void(0);" id="filter-reset">重置</a></li>
									</ul>
								</div>
								<!--通用信息   s-->
								<div class="generalInfo filterInfo tabCard">
									<label class="markMsg"><i></i>通用信息</label>
									<ul>
										<li class="selected">
											<div class="checkbox checkbox-success">
												<input id="create_time" class="styled" type="checkbox" checked="checked">
												<label for="create_time">创建时间<i></i></label>
					             			</div>
										</li>
										<li class="selected">
											<div class="checkbox checkbox-success">
												<input id="salesperson_code" class="styled" type="checkbox" checked="checked">
												<label for="salesperson_code"> 销售 <i></i> </label>
											</div>
										</li>
										<li class="selected">
											<div class="checkbox checkbox-success">
												<input id="currency" class="styled" type="checkbox" checked="checked">
												<label for="currency"> 货币 <i></i> </label>
											</div>
										</li>
										<li class="selected">
											<div class="checkbox checkbox-success">
												<input id="profit" class="styled" type="checkbox" checked="checked">
												<label for="profit"> 利润 <i></i> </label>
											</div>
										</li>
										<li class="selected">
											<div class="checkbox checkbox-success">
												<input id="revenue" class="styled" type="checkbox" checked="checked">
												<label for="revenue"> 收入 <i></i> </label>
											</div>
										</li>
										<li class="selected">
											<div class="checkbox checkbox-success">
												<input id="expense" class="styled" type="checkbox" checked="checked">
												<label for="expense"> 支出 <i></i> </label>
											</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
												<input id="code" class="styled" type="checkbox">
												<label for="code">折扣码 <i></i></label>
											</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
												<input id="coupon" class="styled" type="checkbox">
												<label for="coupon">折扣金额 <i></i></label>
											</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
												<input id="source_name" class="styled" type="checkbox">
												<label for="source_name"> 来源 <i></i> </label>
											</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
												<input id="clear_status" class="styled" type="checkbox">
												<label for="clear_status"> CLEAR <i></i> </label>
											</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
												<input id="lock_status" class="styled" type="checkbox">
												<label for="lock_status"> LOCK <i></i> </label>
											</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
												<input id="note" class="styled" type="checkbox">
												<label for="note">备注 <i></i> </label>
											</div>
										</li>
									</ul>
								</div>
								<!--通用信息   e-->
								<!--机票信息  s-->
								<div class="groupTourInfo filterInfo tabCard">
									<label class="markMsg"><i></i>机票信息</label>
									<ul>
										<li>
											<div class="checkbox checkbox-success">
												<input id="locator" class="styled" type="checkbox">
												<label for="locator">定位<i></i></label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
												<input id="invoice" class="styled" type="checkbox">
												<label for="invoice">INVOICE<i></i></label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
												<input id="received2" class="styled" type="checkbox">
												<label for="received2">返现<i></i></label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
												<input id="flight_code" class="styled" type="checkbox">
												<label for="flight_code">航司大编码<i></i></label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
												<input id="round_trip" class="styled" type="checkbox">
												<label for="round_trip">往返<i></i></label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
												<input id="ticket_type" class="styled" type="checkbox">
												<label for="ticket_type">团散和人数<i></i></label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
												<input id="passenger_number" class="styled" type="checkbox">
												<label for="passenger_number">批发商<i></i></label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
												<input id="refunded" class="styled" type="checkbox">
												<label for="refunded">退款<i></i></label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
												<input id="travel_agency" class="styled" type="checkbox">
												<label for="travel_agency">旅行社来源<i></i></label>
					             			</div>
										</li>
									</ul>
								</div>
								<!--散拼团信息  e-->
								<div class="resultInfo">
									<ul>
										<li class="title">
											<i>结&nbsp;&nbsp;&nbsp;&nbsp;果</i>
										</li>
										<li class="resultNav">
											<dl>
												<dd>#</dd>
												<dd>创建时间</dd>
												<dd>销售</dd>
												<dd>货币</dd>
												<dd>利润</dd>
												<dd>收入</dd>
												<dd>支出</dd>
											</dl>
										</li>
										<li class="resultDetail">
											<dl>
												<dd></dd>
												<dd></dd>
												<dd></dd>
												<dd></dd>
												<dd></dd>
												<dd></dd>
												<dd></dd>
											</dl>
										</li>
									</ul>
									<div class="nav-box eg">
										<ul class="pagination m-style" id="historyOrders"></ul>
									</div>
								</div>
              </div>
						</div>
					</div>
				</div>
				<!--右侧内容             e-->
			</div>
			<!--content  e-->
		</div>
		<script src="../js/jquery.min.js" type="text/javascript"></script>
		<script src="../js/homePage/public.js" type="text/javascript"></script>
		<script src="../js/homePage/accounting.js" type="text/javascript"></script>
		<script src="../js/jquery.pagination.js" type="text/javascript"></script>
		<script src="../js/OrderHistory/airticketOrder.js" type="text/javascript"></script>
	</body>
</html>
