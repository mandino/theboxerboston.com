<?php

// This file was auto-generated from sdk-root/src/data/fms/2018-01-01/api-2.json
return ['version' => '2.0', 'metadata' => ['apiVersion' => '2018-01-01', 'endpointPrefix' => 'fms', 'jsonVersion' => '1.1', 'protocol' => 'json', 'serviceAbbreviation' => 'FMS', 'serviceFullName' => 'Firewall Management Service', 'serviceId' => 'FMS', 'signatureVersion' => 'v4', 'targetPrefix' => 'AWSFMS_20180101', 'uid' => 'fms-2018-01-01'], 'operations' => ['AssociateAdminAccount' => ['name' => 'AssociateAdminAccount', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'AssociateAdminAccountRequest'], 'errors' => [['shape' => 'InvalidOperationException'], ['shape' => 'InvalidInputException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalErrorException']]], 'DeleteNotificationChannel' => ['name' => 'DeleteNotificationChannel', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'DeleteNotificationChannelRequest'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'InvalidOperationException'], ['shape' => 'InternalErrorException']]], 'DeletePolicy' => ['name' => 'DeletePolicy', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'DeletePolicyRequest'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'InvalidOperationException'], ['shape' => 'InternalErrorException']]], 'DisassociateAdminAccount' => ['name' => 'DisassociateAdminAccount', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'DisassociateAdminAccountRequest'], 'errors' => [['shape' => 'InvalidOperationException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalErrorException']]], 'GetAdminAccount' => ['name' => 'GetAdminAccount', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'GetAdminAccountRequest'], 'output' => ['shape' => 'GetAdminAccountResponse'], 'errors' => [['shape' => 'InvalidOperationException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalErrorException']]], 'GetComplianceDetail' => ['name' => 'GetComplianceDetail', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'GetComplianceDetailRequest'], 'output' => ['shape' => 'GetComplianceDetailResponse'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalErrorException']]], 'GetNotificationChannel' => ['name' => 'GetNotificationChannel', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'GetNotificationChannelRequest'], 'output' => ['shape' => 'GetNotificationChannelResponse'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'InvalidOperationException'], ['shape' => 'InternalErrorException']]], 'GetPolicy' => ['name' => 'GetPolicy', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'GetPolicyRequest'], 'output' => ['shape' => 'GetPolicyResponse'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'InvalidOperationException'], ['shape' => 'InternalErrorException']]], 'ListComplianceStatus' => ['name' => 'ListComplianceStatus', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'ListComplianceStatusRequest'], 'output' => ['shape' => 'ListComplianceStatusResponse'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalErrorException']]], 'ListPolicies' => ['name' => 'ListPolicies', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'ListPoliciesRequest'], 'output' => ['shape' => 'ListPoliciesResponse'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'InvalidOperationException'], ['shape' => 'LimitExceededException'], ['shape' => 'InternalErrorException']]], 'PutNotificationChannel' => ['name' => 'PutNotificationChannel', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'PutNotificationChannelRequest'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'InvalidOperationException'], ['shape' => 'InternalErrorException']]], 'PutPolicy' => ['name' => 'PutPolicy', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'PutPolicyRequest'], 'output' => ['shape' => 'PutPolicyResponse'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'InvalidOperationException'], ['shape' => 'InvalidInputException'], ['shape' => 'InternalErrorException']]]], 'shapes' => ['AWSAccountId' => ['type' => 'string', 'max' => 1024, 'min' => 1], 'AssociateAdminAccountRequest' => ['type' => 'structure', 'required' => ['AdminAccount'], 'members' => ['AdminAccount' => ['shape' => 'AWSAccountId']]], 'Boolean' => ['type' => 'boolean'], 'ComplianceViolator' => ['type' => 'structure', 'members' => ['ResourceId' => ['shape' => 'ResourceId'], 'ViolationReason' => ['shape' => 'ViolationReason'], 'ResourceType' => ['shape' => 'ResourceType']]], 'ComplianceViolators' => ['type' => 'list', 'member' => ['shape' => 'ComplianceViolator']], 'DeleteNotificationChannelRequest' => ['type' => 'structure', 'members' => []], 'DeletePolicyRequest' => ['type' => 'structure', 'required' => ['PolicyId'], 'members' => ['PolicyId' => ['shape' => 'PolicyId']]], 'DisassociateAdminAccountRequest' => ['type' => 'structure', 'members' => []], 'ErrorMessage' => ['type' => 'string'], 'EvaluationResult' => ['type' => 'structure', 'members' => ['ComplianceStatus' => ['shape' => 'PolicyComplianceStatusType'], 'ViolatorCount' => ['shape' => 'ResourceCount'], 'EvaluationLimitExceeded' => ['shape' => 'Boolean']]], 'EvaluationResults' => ['type' => 'list', 'member' => ['shape' => 'EvaluationResult']], 'GetAdminAccountRequest' => ['type' => 'structure', 'members' => []], 'GetAdminAccountResponse' => ['type' => 'structure', 'members' => ['AdminAccount' => ['shape' => 'AWSAccountId']]], 'GetComplianceDetailRequest' => ['type' => 'structure', 'required' => ['PolicyId', 'MemberAccount'], 'members' => ['PolicyId' => ['shape' => 'PolicyId'], 'MemberAccount' => ['shape' => 'AWSAccountId']]], 'GetComplianceDetailResponse' => ['type' => 'structure', 'members' => ['PolicyComplianceDetail' => ['shape' => 'PolicyComplianceDetail']]], 'GetNotificationChannelRequest' => ['type' => 'structure', 'members' => []], 'GetNotificationChannelResponse' => ['type' => 'structure', 'members' => ['SnsTopicArn' => ['shape' => 'ResourceArn'], 'SnsRoleName' => ['shape' => 'ResourceArn']]], 'GetPolicyRequest' => ['type' => 'structure', 'required' => ['PolicyId'], 'members' => ['PolicyId' => ['shape' => 'PolicyId']]], 'GetPolicyResponse' => ['type' => 'structure', 'members' => ['Policy' => ['shape' => 'Policy'], 'PolicyArn' => ['shape' => 'ResourceArn']]], 'InternalErrorException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'ErrorMessage']], 'exception' => \true], 'InvalidInputException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'ErrorMessage']], 'exception' => \true], 'InvalidOperationException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'ErrorMessage']], 'exception' => \true], 'LimitExceededException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'ErrorMessage']], 'exception' => \true], 'ListComplianceStatusRequest' => ['type' => 'structure', 'required' => ['PolicyId'], 'members' => ['PolicyId' => ['shape' => 'PolicyId'], 'NextToken' => ['shape' => 'PaginationToken'], 'MaxResults' => ['shape' => 'PaginationMaxResults']]], 'ListComplianceStatusResponse' => ['type' => 'structure', 'members' => ['PolicyComplianceStatusList' => ['shape' => 'PolicyComplianceStatusList'], 'NextToken' => ['shape' => 'PaginationToken']]], 'ListPoliciesRequest' => ['type' => 'structure', 'members' => ['NextToken' => ['shape' => 'PaginationToken'], 'MaxResults' => ['shape' => 'PaginationMaxResults']]], 'ListPoliciesResponse' => ['type' => 'structure', 'members' => ['PolicyList' => ['shape' => 'PolicySummaryList'], 'NextToken' => ['shape' => 'PaginationToken']]], 'ManagedServiceData' => ['type' => 'string', 'max' => 1024, 'min' => 1], 'PaginationMaxResults' => ['type' => 'integer', 'max' => 100, 'min' => 1], 'PaginationToken' => ['type' => 'string', 'min' => 1], 'Policy' => ['type' => 'structure', 'required' => ['PolicyName', 'SecurityServicePolicyData', 'ResourceType', 'ExcludeResourceTags', 'RemediationEnabled'], 'members' => ['PolicyId' => ['shape' => 'PolicyId'], 'PolicyName' => ['shape' => 'ResourceName'], 'PolicyUpdateToken' => ['shape' => 'PolicyUpdateToken'], 'SecurityServicePolicyData' => ['shape' => 'SecurityServicePolicyData'], 'ResourceType' => ['shape' => 'ResourceType'], 'ResourceTags' => ['shape' => 'ResourceTags'], 'ExcludeResourceTags' => ['shape' => 'Boolean'], 'RemediationEnabled' => ['shape' => 'Boolean']]], 'PolicyComplianceDetail' => ['type' => 'structure', 'members' => ['PolicyOwner' => ['shape' => 'AWSAccountId'], 'PolicyId' => ['shape' => 'PolicyId'], 'MemberAccount' => ['shape' => 'AWSAccountId'], 'Violators' => ['shape' => 'ComplianceViolators'], 'EvaluationLimitExceeded' => ['shape' => 'Boolean'], 'ExpiredAt' => ['shape' => 'TimeStamp']]], 'PolicyComplianceStatus' => ['type' => 'structure', 'members' => ['PolicyOwner' => ['shape' => 'AWSAccountId'], 'PolicyId' => ['shape' => 'PolicyId'], 'PolicyName' => ['shape' => 'ResourceName'], 'MemberAccount' => ['shape' => 'AWSAccountId'], 'EvaluationResults' => ['shape' => 'EvaluationResults'], 'LastUpdated' => ['shape' => 'TimeStamp']]], 'PolicyComplianceStatusList' => ['type' => 'list', 'member' => ['shape' => 'PolicyComplianceStatus']], 'PolicyComplianceStatusType' => ['type' => 'string', 'enum' => ['COMPLIANT', 'NON_COMPLIANT']], 'PolicyId' => ['type' => 'string', 'max' => 36, 'min' => 36], 'PolicySummary' => ['type' => 'structure', 'members' => ['PolicyArn' => ['shape' => 'ResourceArn'], 'PolicyId' => ['shape' => 'PolicyId'], 'PolicyName' => ['shape' => 'ResourceName'], 'ResourceType' => ['shape' => 'ResourceType'], 'SecurityServiceType' => ['shape' => 'SecurityServiceType'], 'RemediationEnabled' => ['shape' => 'Boolean']]], 'PolicySummaryList' => ['type' => 'list', 'member' => ['shape' => 'PolicySummary']], 'PolicyUpdateToken' => ['type' => 'string', 'max' => 1024, 'min' => 1], 'PutNotificationChannelRequest' => ['type' => 'structure', 'required' => ['SnsTopicArn', 'SnsRoleName'], 'members' => ['SnsTopicArn' => ['shape' => 'ResourceArn'], 'SnsRoleName' => ['shape' => 'ResourceArn']]], 'PutPolicyRequest' => ['type' => 'structure', 'required' => ['Policy'], 'members' => ['Policy' => ['shape' => 'Policy']]], 'PutPolicyResponse' => ['type' => 'structure', 'members' => ['Policy' => ['shape' => 'Policy'], 'PolicyArn' => ['shape' => 'ResourceArn']]], 'ResourceArn' => ['type' => 'string', 'max' => 1024, 'min' => 1], 'ResourceCount' => ['type' => 'long', 'min' => 0], 'ResourceId' => ['type' => 'string', 'max' => 1024, 'min' => 1], 'ResourceName' => ['type' => 'string', 'max' => 128, 'min' => 1], 'ResourceNotFoundException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'ErrorMessage']], 'exception' => \true], 'ResourceTag' => ['type' => 'structure', 'required' => ['Key'], 'members' => ['Key' => ['shape' => 'TagKey'], 'Value' => ['shape' => 'TagValue']]], 'ResourceTags' => ['type' => 'list', 'member' => ['shape' => 'ResourceTag'], 'max' => 8, 'min' => 0], 'ResourceType' => ['type' => 'string', 'max' => 128, 'min' => 1], 'SecurityServicePolicyData' => ['type' => 'structure', 'required' => ['Type'], 'members' => ['Type' => ['shape' => 'SecurityServiceType'], 'ManagedServiceData' => ['shape' => 'ManagedServiceData']]], 'SecurityServiceType' => ['type' => 'string', 'enum' => ['WAF']], 'TagKey' => ['type' => 'string', 'max' => 128, 'min' => 1, 'pattern' => '^([\\p{L}\\p{Z}\\p{N}_.:/=+\\-@]*)$'], 'TagValue' => ['type' => 'string', 'max' => 256, 'pattern' => '^([\\p{L}\\p{Z}\\p{N}_.:/=+\\-@]*)$'], 'TimeStamp' => ['type' => 'timestamp'], 'ViolationReason' => ['type' => 'string', 'enum' => ['WEB_ACL_MISSING_RULE_GROUP', 'RESOURCE_MISSING_WEB_ACL', 'RESOURCE_INCORRECT_WEB_ACL']]]];
