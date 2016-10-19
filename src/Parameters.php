<?php

/**
 * Title: Ogone parameters constants
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.3.2
 * @since 1.0.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_Parameters {
	//////////////////////////////////////////////////
	// IN
	//////////////////////////////////////////////////

	/**
	 * Indicator for the PSPID parameter.
	 *
	 * @var string
	 */
	const PSPID = 'PSPID';

	/**
	 * Indicator for the ORDERID parameter.
	 *
	 * @var string
	 */
	const ORDERID = 'ORDERID';

	/**
	 * Indicator for the AMOUNT parameter.
	 *
	 * @var string
	 */
	const AMOUNT = 'AMOUNT';

	/**
	 * Indicator for the CURRENCY parameter.
	 *
	 * @var string
	 */
	const CURRENCY = 'CURRENCY';

	/**
	 * Indicator for the AMOUNT parameter.
	 *
	 * @var string
	 */
	const LANGUAGE = 'LANGUAGE';

	//////////////////////////////////////////////////

	/**
	 * Indicator for the CN parameter.
	 *
	 * @var string
	 */
	const CUSTOMER_NAME = 'CN';

	/**
	 * Indicator for the EMAIL parameter.
	 *
	 * @var string
	 */
	const EMAIL = 'EMAIL';

	//////////////////////////////////////////////////

	/**
	 * Indicator for the OWNERADDRESS parameter.
	 *
	 * @var string
	 */
	const OWNER_ADDRESS = 'OWNERADDRESS';

	/**
	 * Indicator for the OWNERADDRESS2 parameter.
	 *
	 * @var string
	 */
	const OWNER_ADDRESS_2 = 'OWNERADDRESS2';

	/**
	 * Indicator for the OWNERCTY parameter.
	 *
	 * @var string
	 */
	const OWNER_COUNTRY = 'OWNERCTY';

	/**
	 * Indicator for the OWNERTELNO parameter.
	 *
	 * @var string
	 */
	const OWNER_TELNO = 'OWNERTELNO';

	/**
	 * Indicator for the OWNERTOWN parameter.
	 *
	 * @var string
	 */
	const OWNER_TOWN = 'OWNERTOWN';

	/**
	 * Indicator for the OWNERZIP parameter.
	 *
	 * @var string
	 */
	const OWNER_ZIP = 'OWNERZIP';

	//////////////////////////////////////////////////

	/**
	 * Indicator for the COM parameter.
	 *
	 * @var string
	 */
	const COM = 'COM';

	//////////////////////////////////////////////////

	/**
	 * Indicator for the ACCEPTURL parameter.
	 *
	 * @var string
	 */
	const ACCEPT_URL = 'ACCEPTURL';

	/**
	 * Indicator for the DECLINEURL parameter.
	 *
	 * @var string
	 */
	const DECLINE_URL = 'DECLINEURL';

	/**
	 * Indicator for the EXCEPTIONURL parameter.
	 *
	 * @var string
	 */
	const EXCEPTION_URL = 'EXCEPTIONURL';

	/**
	 * Indicator for the CANCELURL parameter.
	 *
	 * @var string
	 */
	const CANCEL_URL = 'CANCELURL';

	//////////////////////////////////////////////////

	/**
	 * Indicator for the PARAMPLUS parameter.
	 *
	 * @var string
	 */
	const PARAM_PLUS = 'PARAMPLUS';

	//////////////////////////////////////////////////
	// OUT
	//////////////////////////////////////////////////

	/**
	 * Indicator for the STATUS parameter.
	 *
	 * @var string
	 */
	const STATUS = 'STATUS';

	//////////////////////////////////////////////////
	// Network computer (nc) parameters
	//////////////////////////////////////////////////

	/**
	 * Indicator for the NCSTATUS parameter.
	 *
	 * Error status. In general this is the first digit of the NCERROR.
	 *
	 * @var string
	 */
	const NC_STATUS = 'NCSTATUS';

	/**
	 * Indicator for the NCERROR parameter.
	 *
	 * Error code.
	 * The value of this parameter is 0 or empty if not applicable.
	 *
	 * @var string
	 */
	const NC_ERROR = 'NCERROR';

	/**
	 * Indicator for the NCERRORPLUS parameter.
	 *
	 * Error description of the NCERROR code.
	 * The value of this parameter is 0 or empty if not applicable.

	 * @var string
	 */
	const NC_ERROR_PLUS = 'NCERRORPLUS';

	//////////////////////////////////////////////////
	// API user parameters
	//////////////////////////////////////////////////

	/**
	 * Indicator for the USERID parameter.
	 *
	 * @since 1.3.2
	 * @var string
	 */
	const USER_ID = 'USERID';

	/**
	 * Indicator for the PSWD parameter.
	 *
	 * @since 1.3.2
	 * @var string
	 */
	const PASSWORD = 'PSWD';
}
